<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "connect".
 *
 * @property int $connect_id
 * @property int $project_id
 * @property int $user_id
 * @property string $created_at
 * @property int|null $status
 *
 * @property Project $project
 * @property User $user
 */
class Connect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'connect';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id'], 'required'],
            [['project_id', 'user_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'connect_id' => 'Connect ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery|ProjectQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ConnectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConnectQuery(get_called_class());
    }
}
