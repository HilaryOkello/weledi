<?php

namespace frontend\models;

use common\models\User;
use common\models\UserQuery;
use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $project_id
 * @property string $project_title
 * @property int $user_id
 * @property string $brief
 * @property int $location_id
 * @property string $duration
 * @property string $date
 * @property string $created_at
 * @property int $status
 *
 * @property Connect[] $connects
 * @property Location $location
 * @property User $user
 * @property ProjectDocs[] $projectDocs
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        	[['project_title', 'user_id', 'brief', 'location_id', 'duration'], 'required'],
            [['user_id', 'location_id', 'status'], 'integer'],
            [['brief'], 'string'],
            [['date', 'created_at'], 'safe'],
        	[['project_title', 'duration'], 'string', 'max' => 100],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'location_id']],
        	[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
        	'project_title' => 'Project Title',
            'user_id' => 'User ID',
            'brief' => 'Brief',
            'location_id' => 'Location ID',
            'duration' => 'Duration',
            'date' => 'Date',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Connects]].
     *
     * @return \yii\db\ActiveQuery|ConnectQuery
     */
    public function getConnects()
    {
        return $this->hasMany(Connect::className(), ['project_id' => 'project_id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['location_id' => 'location_id']);
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
     * Gets query for [[ProjectDocs]].
     *
     * @return \yii\db\ActiveQuery|ProjectDocsQuery
     */
    public function getProjectDocs()
    {
        return $this->hasMany(ProjectDocs::className(), ['project_id' => 'project_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
