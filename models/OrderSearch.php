<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public static function tableName()
    {
        return 'order';
    }
    public $customer_id;
    public $labelName;
    public $manager_id;
    public $pants_id;
    public $shaft_id;
    public $label_status_id;
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','label_id','manager_id','pants_id','shaft_id','status_id','label_status_id','mashine_id','customer_id'], 'integer'],
            [['labelName'], 'trim'],
            [['date_of_create'], 'safe'],
        ];
    }

    public function attributeLabels(){
        return[
            'manager_id'=>'Менеджер',
            'label_status_id'=>'Статус этикетки',
            'labelName'=>'Наименование',
            'shaft_id'=>'Вал',
            'pants_id'=>'Штанец',
            'customer_id'=>'Заказчик',
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $dataProvider->setSort([
            'defaultOrder' => ['id'=>SORT_DESC],
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
        $query->andFilterWhere(['order.id' => $this->id]);
        $query->andFilterWhere(['order.mashine_id' => $this->mashine_id]);
        $query->andFilterWhere(['order.label_id' => $this->label_id]);
        $query->andFilterWhere(['customer.user_id' => $this->manager_id]);
        $query->andFilterWhere(['like', 'label.name', $this->labelName]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.customer_id'=> $this->customer_id]);
            }]);
        $query->joinWith(['customer' => function ($q) {
                $q->andFilterWhere(['customer.user_id'=> $this->manager_id]);
            }]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.status_id'=> $this->label_status_id]);
            }]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.pants_id'=> $this->pants_id]);
            }]);
        $query->joinWith(['shaft' => function ($q) {
                $q->andFilterWhere(['shaft.id'=> $this->shaft_id]);
            }]);
        $query->andFilterWhere(['order.status_id'=> $this->status_id]);
            if(isset ($this->date_of_create) && $this->date_of_create!=''){
                $date_explode=explode(" - ",$this->date_of_create);
                $date1=trim($date_explode[0]);
                $date2=trim($date_explode[1]);
                if($date1!=$date2) {
                    $query->andWhere("order.date_of_create BETWEEN str_to_date('$date1' ,'%d.%m.%Y %H-%i-%S') AND str_to_date('$date2' ,'%d.%m.%Y %H-%i-%S') ");
                }else{
                    $query->andWhere("order.date_of_create BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
                }
            }
        return $dataProvider;
    }
}