<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class FinishedProductsWarehouseSearch extends FinishedProductsWarehouse
{
    public $manager_id;
    public static function tableName()
    {
        return 'finished_products_warehouse';
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['label_in_roll','roll_count','label_id','order_id','id','manager_id'], 'integer'],
            [['id','status_id','date_of_create','label_id','order_id','roll_count','label_in_roll'], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = FinishedProductsWarehouse::find()->where(['order_id'=>null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $dataProvider->setSort([
            'attributes' => [
//                'id',
//                'name',
//                'date_of_create'
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['finished_products_warehouse.id' => $this->id]);
        $query->andFilterWhere(['finished_products_warehouse.label_id' => $this->label_id]);
        $query->andFilterWhere(['finished_products_warehouse.roll_count' => $this->roll_count]);
        $query->andFilterWhere(['finished_products_warehouse.label_in_roll' => $this->label_in_roll]);
        $query->joinWith(['customer' => function ($q) {
            $q->andFilterWhere(['customer.user_id'=> $this->manager_id]);
        }]);

        return $dataProvider;
    }
}