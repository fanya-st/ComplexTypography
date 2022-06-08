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
    public $customerId;
    public $labelName;
    public $pantsId;
    public $shaftId;
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [[], 'integer'],
            [['labelName'], 'trim'],
            [['customerId','name','label_id','id','manager_login','date_of_create','status_id','pantsId','shaftId','mashine_id'], 'safe'],
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
            'attributes' => [
//                'id',
//                'name',
//                'date_of_create'
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['label']);
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['order.id' => $this->id]);
        $query->andFilterWhere(['order.mashine_id' => $this->mashine_id]);
        $query->andFilterWhere(['order.label_id' => $this->label_id]);
        $query->andFilterWhere(['like', 'label.name', $this->labelName]);
        $query->andFilterWhere(['order.manager_login'=> $this->manager_login]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.customer_id'=> $this->customerId]);
            }]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.pants_id'=> $this->pantsId]);
            }]);
        $query->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.shaft_id'=> $this->shaftId]);
            }]);
//        $query->andFilterWhere(['shaft_id'=> $this->shaft_id]);
//        $query->andFilterWhere(['pants_id'=> $this->pants_id]);
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