<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Connect]].
 *
 * @see Connect
 */
class ConnectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Connect[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Connect|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
