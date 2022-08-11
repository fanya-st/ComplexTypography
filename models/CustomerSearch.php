<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CustomerSearch extends Customer
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','status_id'], 'integer'],
            [['name','manager_login'], 'trim'],
            [['date_of_agreement'], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $dataProvider->setSort([
            'attributes' => [
//                'order.id'
//                'name',
//                'date_of_create'=>[
//                    'asc' => ['date_of_create' => SORT_ASC],
//                    'desc' => ['date_of_create' => SORT_DESC],
//                    'default' => SORT_DESC
//                ],
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['status_id' => $this->status_id]);
        $query->andFilterWhere(['manager_login' => $this->manager_login]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->where(['=', 'date_of_agreement', Date('Y-m-d', strtotime($this->date_of_agreement))]);
        return $dataProvider;
    }
}