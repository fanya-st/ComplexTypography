<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shelf;


class ShelfSearch extends Shelf
{
    public $warehouse_id;
    public static function tableName()
    {
        return 'shelf';
    }

    public function rules()
    {
        return [
            [['id', 'rack_id','warehouse_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Shelf::find()->joinWith('rack.warehouse');

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
            'shelf.id' => $this->id,
            'shelf.rack_id' => $this->rack_id,
            'warehouse.id' => $this->warehouse_id,
        ]);

        return $dataProvider;
    }
}
