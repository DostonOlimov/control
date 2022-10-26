<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form of `common\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['id_country', 'name_country', 'code_country'], 'safe'],
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
        $query = Country::find();

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
            'id' => $this->id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'id_country', $this->id_country])
            ->andFilterWhere(['like', 'name_country', $this->name_country])
            ->andFilterWhere(['like', 'code_country', $this->code_country]);

        return $dataProvider;
    }
    public function searchbyName($name)
    {
        $query = Country::find()
        ->where(['name_country' => $name])
        ->one();

             // add conditions that should always apply here


          return $query;
           
    }
}
