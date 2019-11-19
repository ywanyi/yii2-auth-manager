<?php

namespace yii\auth\models;

use Yii;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Assignment[] $assignments
 * @property Rule $ruleName
 * @property ItemChild[] $itemParents
 * @property ItemChild[] $itemChildren
 * @property Item[] $children
 * @property Item[] $parents
 */
class Item extends \yii\db\ActiveRecord
{

    protected $parent;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => 'created_at'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => Rule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(Assignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(Rule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemParents()
    {
        return $this->hasMany(ItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemChildren()
    {
        return $this->hasMany(ItemChild::className(), ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getChildren()
    {
        return $this->hasMany(Item::className(), ['name' => 'child'])->viaTable('{{%auth_item_child}}', ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getParents()
    {
        return $this->hasMany(Item::className(), ['name' => 'parent'])->viaTable('{{%auth_item_child}}', ['child' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}
