<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


class UserSearch extends User
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['id','status_id'], 'integer'],
            [['username'], 'string','max'=>50],
            [['F','I','O'],'string','max'=>100],
            [['username','F','I','O'],'trim'],
        ];
    }


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
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
            'username' => $this->username,
            'F' => $this->F,
            'I' => $this->I,
            'O' => $this->O,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
