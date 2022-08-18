<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PantoneWarehouse;


class PantoneWarehouseSearch extends PantoneWarehouse
{
    public static function tableName()
    {
        return 'pantone_warehouse';
    }

    public function rules()
    {
        return [
            [['id', 'pantone_id'], 'integer'],
            [['weight'], 'number'],
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
        $query = PantoneWarehouse::find();

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
            'pantone_id' => $this->pantone_id,
            'weight' => $this->weight,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
