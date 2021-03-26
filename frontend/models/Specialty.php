<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "specialty".
 *
 * @property int $specialty_id
 * @property string $specialty_name
 *
 * @property Pprofile[] $pprofiles
 */
class Specialty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialty_name'], 'required'],
            [['specialty_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'specialty_id' => 'Specialty ID',
            'specialty_name' => 'Specialty Name',
        ];
    }

    /**
     * Gets query for [[Pprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPprofiles()
    {
        return $this->hasMany(Pprofile::className(), ['specialty_id' => 'specialty_id']);
    }
}
