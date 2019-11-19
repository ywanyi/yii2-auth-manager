<?php

namespace yii\auth\models;

use Yii;

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property string $name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Role[] $roles
 * @property Permission[] $permissions
 */
class Rule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['rule_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['rule_name' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return RuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RuleQuery(get_called_class());
    }
}
