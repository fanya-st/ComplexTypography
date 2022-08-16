<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CalcMashineParamPrice;


class CalcMashineParamValueSearch extends CalcMashineParamValue
{
    public static function tableName()
    {
        return 'calc_mashine_param_value';
    }

    public function rules()
    {
        return [
            [['id', 'mashine_id', 'calc_mashine_param_id'], 'integer'],
            [['value'], 'number'],
            [['date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CalcMashineParamValue::find();

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
            'mashine_id' => $this->mashine_id,
            'calc_mashine_param_id' => $this->calc_mashine_param_id,
            'value' => $this->value,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
