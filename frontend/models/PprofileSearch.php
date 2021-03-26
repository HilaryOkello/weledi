<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pprofile;

/**
 * PprofileSearch represents the model behind the search form of `frontend\models\Pprofile`.
 */
class PprofileSearch extends Pprofile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pprofile_id', 'user_id', 'phone_code', 'phone_number', 'id_number', 'specialty_id', 'payment_id', 'location_id', 'identity_doc'], 'integer'],
            [['first_name', 'last_name', 'profile_image', 'introduction', 'about', 'address', 'tags'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pprofile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pprofile_id' => $this->pprofile_id,
            'user_id' => $this->user_id,
            'phone_code' => $this->phone_code,
            'phone_number' => $this->phone_number,
            'id_number' => $this->id_number,
            'specialty_id' => $this->specialty_id,
            'payment_id' => $this->payment_id,
            'location_id' => $this->location_id,
            'identity_doc' => $this->identity_doc,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'profile_image', $this->profile_image])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
