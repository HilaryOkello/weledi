<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "deposit".
 *
 * @property int $transId
 * @property string|null $MerchantRequestId
 * @property int $walletId
 * @property int $transAmount
 * @property int $phoneCode
 * @property int $mpesaNumber
 * @property string $details
 * @property string|null $receipt
 * @property string $transDate
 * @property int $createdBy
 * @property int|null $status
 */
class Deposit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['walletId', 'transAmount', 'phoneCode', 'mpesaNumber', 'details', 'createdBy'], 'required'],
            [['walletId', 'transAmount', 'phoneCode', 'mpesaNumber', 'createdBy', 'status'], 'integer'],
            [['details'], 'string'],
            [['transDate'], 'safe'],
            [['MerchantRequestId', 'receipt'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transId' => 'Trans ID',
            'MerchantRequestId' => 'Merchant Request ID',
            'walletId' => 'Wallet ID',
            'transAmount' => 'Trans Amount',
            'phoneCode' => 'Phone Code',
            'mpesaNumber' => 'Mpesa Number',
            'details' => 'Details',
            'receipt' => 'Receipt',
            'transDate' => 'Trans Date',
            'createdBy' => 'Created By',
            'status' => 'Status',
        ];
    }
}
