<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cprofile;

/**
 * CprofileSearch represents the model behind the search form of `frontend\models\Cprofile`.
 */
class CprofileSearch extends Cprofile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cprofile_id', 'user_id', 'phone_code', 'phone_number', 'id_number'], 'integer'],
            [['first_name', 'last_name', 'created_at', 'cprofile_image'], 'safe'],
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
        $query = Cprofile::find();

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
            'cprofile_id' => $this->cprofile_id,
            'user_id' => $this->user_id,
            'phone_code' => $this->phone_code,
            'phone_number' => $this->phone_number,
            'id_number' => $this->id_number,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'cprofile_image', $this->cprofile_image]);

        return $dataProvider;
    }
}
