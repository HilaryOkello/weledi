<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Pprofile]].
 *
 * @see Pprofile
 */
class PprofileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pprofile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pprofile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function byKeyword($keyword)
    {
    	return $this->andWhere("MATCH(specialty, introduction, about, location, first_name, last_name, location, tags)
        AGAINST (:keyword)", ['keyword' => $keyword]);
    }
}
