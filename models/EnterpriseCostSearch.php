<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EnterpriseCost;


class EnterpriseCostSearch extends EnterpriseCost
{
    public static function tableName()
    {
        return 'enterprise_cost';
    }

    public function rules()
    {
        return [
            [['id', 'service_id'], 'integer'],
            [['date', 'login'], 'safe'],
            [['cost'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EnterpriseCost::find();

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
            'date' => $this->date,
            'service_id' => $this->service_id,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'login', $this->login]);

        return $dataProvider;
    }
}
