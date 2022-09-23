<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_group".
 *
 * @property int $id
 * @property string $name
 *
 * @property Material[] $materials
 * @property Pants[] $pants
 */
class MaterialGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasMany(Material::class, ['material_group_id' => 'id']);
    }

    /**
     * Gets query for [[Pants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPants()
    {
        return $this->hasMany(Pants::class, ['material_group_id' => 'id']);
    }
}
