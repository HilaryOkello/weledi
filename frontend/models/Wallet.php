<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property int $walletId
 * @property int $userId
 * @property int $currencyId
 * @property int $balance
 */
class Wallet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'currencyId'], 'required'],
            [['userId', 'currencyId', 'balance'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'walletId' => 'Wallet ID',
            'userId' => 'User ID',
            'currencyId' => 'Currency ID',
            'balance' => 'Balance',
        ];
    }
}
