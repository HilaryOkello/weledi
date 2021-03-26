<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[ProjectDocs]].
 *
 * @see ProjectDocs
 */
class ProjectDocsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectDocs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectDocs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
