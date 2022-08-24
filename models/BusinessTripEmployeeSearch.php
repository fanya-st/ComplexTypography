<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BusinessTripEmployee;

class BusinessTripEmployeeSearch extends BusinessTripEmployee
{
    public static function tableName()
    {
        return 'business_trip_employee';
    }

    public function rules()
    {
        return [
            [['id', 'transport_id', 'status_id'], 'integer'],
            [['date_of_begin', 'date_of_end', 'employee_login', 'address'], 'safe'],
            [['address'], 'trim'],
            [['gasoline_cost', 'cost'], 'number'],
        ];
    }


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function search($params)
    {
        $query = BusinessTripEmployee::find();

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
            'date_of_begin' => $this->date_of_begin,
            'date_of_end' => $this->date_of_end,
            'employee_login' => $this->employee_login,
            'gasoline_cost' => $this->gasoline_cost,
            'cost' => $this->cost,
            'transport_id' => $this->transport_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
