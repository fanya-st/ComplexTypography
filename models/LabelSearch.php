<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class LabelSearch extends Label
{
    public static function tableName()
    {
        return 'label';
    }
    public $pantsName;
    public $labelStatusName;
    public $varnishStatusName;
    public $customerName;
    public $fullName;
    public $shaftName;

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','pantsName'], 'integer'],
            [['name','customerName','date_of_create'], 'trim'],
            [['status_id','designer_login','pants','labelStatusName',
                'varnishStatusName','foil','fullName','shaftName'], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Label::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'date_of_create'=>[
                    'default'=>SORT_DESC
                ],
                'customerName'=>[
                    'asc'=>['customer.name' => SORT_ASC],
                    'desc'=>['customer.name' => SORT_DESC],
                ],
                'pantsName'=>[
                    'asc'=>['pants.name' => SORT_ASC],
                    'desc'=>['pants.name' => SORT_DESC],
                ],
                'labelStatusName'=>[
                    'asc'=>['label_status.name' => SORT_ASC],
                    'desc'=>['label_status.name' => SORT_DESC],
                ],
                'shaftName' => [
                    'asc' => ['shaft.name' => SORT_ASC],
                    'desc' => ['shaft.name' => SORT_DESC]
                ]
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['labelStatus']);
            $query->joinWith(['customer']);
            $query->joinWith(['pants']);
            $query->joinWith(['varnishStatus']);
            $query->joinWith(['shaft']);
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['label.id' => $this->id]);
        $query->andFilterWhere(['like', 'label.name', $this->name]);
        $query->andFilterWhere(['designer_login'=> $this->fullName]);
        $query->joinWith(['shaft' => function ($q) {
            $q->andFilterWhere(['shaft.name'=> $this->shaftName]);
        }]);
        $query->joinWith(['labelStatus' => function ($q) {
            $q->andFilterWhere(['like', 'label_status.name', $this->labelStatusName]);
        }]);
            $query->joinWith(['customer' => function ($q) {
                $q->andFilterWhere(['like', 'customer.name', $this->customerName]);
            }]);

            if(isset ($this->date_of_create)&&$this->date_of_create!=''){
                $date_explode=explode(" - ",$this->date_of_create);
                $date1=trim($date_explode[0]);
                $date2=trim($date_explode[1]);
                if($date1!=$date2) {
                    $query->andWhere("date_of_create BETWEEN CAST('$date1' AS DATE) AND CAST('$date2' AS DATE) ");
                }else{
                    $query->andWhere("date_of_create BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
                }
                
            };
        $query->joinWith(['pants' => function ($q) {
            $q->andFilterWhere(['pants.name' => $this->pantsName]);
        }]);
        $query->joinWith(['varnishStatus' => function ($q) {
            $q->andFilterWhere(['like', 'varnish_status.name', $this->varnishStatusName]);
        }]);


        return $dataProvider;
    }
}