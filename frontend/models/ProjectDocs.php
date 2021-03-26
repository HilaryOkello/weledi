<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "project_docs".
 *
 * @property int $project_docs_id
 * @property string $project_docs_path
 * @property int $project_id
 *
 * @property Project $project
 */
class ProjectDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_docs_path', 'project_id'], 'required'],
            [['project_id'], 'integer'],
            [['project_docs_path'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_docs_id' => 'Project Docs ID',
            'project_docs_path' => 'Project Docs Path',
            'project_id' => 'Project ID',
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
     * {@inheritdoc}
     * @return ProjectDocsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectDocsQuery(get_called_class());
    }
}
