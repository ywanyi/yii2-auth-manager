<?php

namespace yii\auth\models;

use Yii;
use yii\helpers\ArrayHelper;

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
 * @property Permission[] $children
 * @property Permission[] $parents
 */
class Permission extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
//            [['type'], 'default', \yii\rbac\Item::TYPE_PERMISSION]
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Permission::className(), ['name' => 'child'])->viaTable('{{%auth_item_child}}', ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(Permission::className(), ['name' => 'parent'])->viaTable('{{%auth_item_child}}', ['child' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return PermissionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PermissionQuery(get_called_class());
    }
}
