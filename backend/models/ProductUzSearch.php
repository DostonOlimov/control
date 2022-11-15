<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductUz;

/**
 * ProductUzSearch represents the model behind the search form of `common\models\ProductUz`.
 */
class ProductUzSearch extends ProductUz
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'type_of_alert', 'type', 'category', 'status', 'views', 'company_inn', 'created_at', 'updated_at'], 'integer'],
            [['lang', 'codetnved', 'alert_number', 'counterfeit', 'risk_type', 'product', 'name', 'description', 'brand', 'type_number_of_model', 'batch_number_barcode', 'technical_defect', 'products_were_found_and_measures_were_taken_also_in', 'barcode', 'batch_number', 'company_recall_code', 'production_dates', 'packaging_description', 'photo', 'company_name'], 'safe'],
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
        $query = ProductUz::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'codetnved', $this->codetnved])
            ->andFilterWhere(['like', 'type_of_alert', $this->type_of_alert])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'alert_number', $this->alert_number])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_inn', $this->company_inn])
            ->andFilterWhere(['like', 'counterfeit', $this->counterfeit])
            ->andFilterWhere(['like', 'risk_type', $this->risk_type])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'type_number_of_model', $this->type_number_of_model])
            ->andFilterWhere(['like', 'batch_number_barcode', $this->batch_number_barcode])
            ->andFilterWhere(['like', 'technical_defect', $this->technical_defect])
            ->andFilterWhere(['like', 'products_were_found_and_measures_were_taken_also_in', $this->products_were_found_and_measures_were_taken_also_in])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'company_recall_code', $this->company_recall_code])
            ->andFilterWhere(['like', 'production_dates', $this->production_dates])
            ->andFilterWhere(['like', 'packaging_description', $this->packaging_description]);

        $query->andFilterWhere(['lang' => 'cyrl']);
        $query->orderBy('id DESC');

        return $dataProvider;
    }
    public function searchCategoryId()
    {
        $query = ProductUz::find()
            ->where(['photo' => null])
            ->all();

        // add conditions that should always apply here


        return $query;

    }
}
