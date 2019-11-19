<?php

namespace yii\auth\models;

use Yii;

/**
 * This is the model class for table "{{%auth_assignment}}".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 *
 * @property Role|Permission $itemName
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Item Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(Item::className(), ['name' => 'item_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['name' => 'item_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(Permission::className(), ['name' => 'item_name']);
    }

    /**
     * {@inheritdoc}
     * @return AssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AssignmentQuery(get_called_class());
    }
}
