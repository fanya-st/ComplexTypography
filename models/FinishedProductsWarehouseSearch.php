<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class FinishedProductsWarehouseSearch extends FinishedProductsWarehouse
{
    public $managerLogin;
    public static function tableName()
    {
        return 'finished_products_warehouse';
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['label_in_roll','roll_count','label_id','order_id','id'], 'integer'],
            [['managerLogin'], 'trim'],
            [['id','status_id','date_of_create','managerLogin','label_id','order_id','roll_count','label_in_roll'], 'safe'],
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
            $q->andFilterWhere(['customer.manager_login'=> $this->managerLogin]);
        }]);
//        $query->andFilterWhere(['customer_id'=> $this->customer_id]);
//        $query->joinWith(['pants' => function ($q) {
//            $q->andFilterWhere(['pants.shaft_id'=> $this->shaft_id]);
//        }]);
//        $query->andFilterWhere(['pants_id'=> $this->pants_id]);
//        $query->andFilterWhere(['label.status_id'=> $this->status_id]);
//        if(isset ($this->date_of_create)&&$this->date_of_create!=''){
//            $date_explode=explode(" - ",$this->date_of_create);
//            $date1=trim($date_explode[0]);
//            $date2=trim($date_explode[1]);
//            if($date1!=$date2) {
//                $query->andWhere("date_of_create BETWEEN str_to_date('$date1' ,'%d.%m.%Y %H-%i-%S') AND str_to_date('$date2' ,'%d.%m.%Y %H-%i-%S') ");
//            }else{
//                $query->andWhere("date_of_create BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
//            }
//        }
        return $dataProvider;
    }
}