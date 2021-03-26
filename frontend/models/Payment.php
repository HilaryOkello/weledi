<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $payment_id
 * @property string $payment_name
 *
 * @property Pprofile[] $pprofiles
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_name'], 'required'],
            [['payment_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'payment_name' => 'Payment Name',
        ];
    }

    /**
     * Gets query for [[Pprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPprofiles()
    {
        return $this->hasMany(Pprofile::className(), ['payment_id' => 'payment_id']);
    }
}
