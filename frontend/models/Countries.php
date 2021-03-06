<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $countryId
 * @property string $countryName
 * @property string|null $couPhoneCode
 *
 * @property Cprofile[] $cprofiles
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['countryName'], 'required'],
            [['countryName', 'couPhoneCode'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'countryId' => 'Country ID',
            'countryName' => 'Country Name',
            'couPhoneCode' => 'Cou Phone Code',
        ];
    }

    /**
     * Gets query for [[Cprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCprofiles()
    {
        return $this->hasMany(Cprofile::className(), ['phone_code' => 'countryId']);
    }
}
