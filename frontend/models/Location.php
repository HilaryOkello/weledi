<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $location_id
 * @property string $location_name
 *
 * @property Pprofile[] $pprofiles
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_name'], 'required'],
            [['location_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'location_name' => 'Location Name',
        ];
    }

    /**
     * Gets query for [[Pprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPprofiles()
    {
        return $this->hasMany(Pprofile::className(), ['location_id' => 'location_id']);
    }
}
