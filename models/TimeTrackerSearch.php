<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


class TimeTrackerSearch extends TimeTracker
{
    public static function tableName()
    {
        return 'time_tracker';
    }

    public function rules()
    {
        return [
            [['employee_login'], 'string'],
            [['employee_login'], 'trim'],
            [['date_of_action'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TimeTracker::find();

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
            'employee_login' => $this->employee_login,
        ]);
        $query->orderBy([
            'id' => SORT_ASC,
        ]);

        return $dataProvider;
    }
}
