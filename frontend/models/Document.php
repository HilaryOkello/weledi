<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $document_id
 * @property string $document_path
 * @property int $pprofile_id
 *
 * @property Pprofile $pprofile
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pprofile_id'], 'required'],
            [['pprofile_id'], 'integer'],
            [['document_path'], 'string', 'max' => 512],
            [['pprofile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pprofile::className(), 'targetAttribute' => ['pprofile_id' => 'pprofile_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'Document ID',
            'document_path' => 'Document Path',
            'pprofile_id' => 'Pprofile ID',
        ];
    }

    /**
     * Gets query for [[Pprofile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPprofile()
    {
        return $this->hasOne(Pprofile::className(), ['pprofile_id' => 'pprofile_id']);
    }
}
