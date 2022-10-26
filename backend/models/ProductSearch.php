<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['codetnved', 'type_of_alert', 'type', 'alert_number', 'alert_submitted_by', 'country_of_origin', 'counterfeit', 'risk_type', 'product', 'name', 'description', 'brand', 'category', 'type_number_of_model', 'batch_number_barcode', 'oecd_portal_category', 'risk', 'technical_defect', 'measures_adopted_by_notifying_country', 'products_were_found_and_measures_were_taken_also_in', 'company_recall_page', 'url_of_case', 'barcode', 'batch_number', 'company_recall_code', 'production_dates', 'packaging_description'], 'safe'],
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
        $query = Product::find();

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
            ->andFilterWhere(['like', 'alert_submitted_by', $this->alert_submitted_by])
            ->andFilterWhere(['like', 'country_of_origin', $this->country_of_origin])
            ->andFilterWhere(['like', 'counterfeit', $this->counterfeit])
            ->andFilterWhere(['like', 'risk_type', $this->risk_type])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'type_number_of_model', $this->type_number_of_model])
            ->andFilterWhere(['like', 'batch_number_barcode', $this->batch_number_barcode])
            ->andFilterWhere(['like', 'oecd_portal_category', $this->oecd_portal_category])
            ->andFilterWhere(['like', 'risk', $this->risk])
            ->andFilterWhere(['like', 'technical_defect', $this->technical_defect])
            ->andFilterWhere(['like', 'measures_adopted_by_notifying_country', $this->measures_adopted_by_notifying_country])
            ->andFilterWhere(['like', 'products_were_found_and_measures_were_taken_also_in', $this->products_were_found_and_measures_were_taken_also_in])
            ->andFilterWhere(['like', 'company_recall_page', $this->company_recall_page])
            ->andFilterWhere(['like', 'url_of_case', $this->url_of_case])
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
        $query = Product::find()
        ->where(['photo' => null])
        ->all();

             // add conditions that should always apply here


          return $query;
           
    }
}
