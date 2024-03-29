<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthAssignment;


class AuthAssignmentSearch extends AuthAssignment
{

    public static function tableName()
    {
        return 'auth_assignment';
    }

    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'safe'],
            [['created_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthAssignment::find();

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
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
            'item_name' => $this->item_name,
        ]);

        return $dataProvider;
    }
}
