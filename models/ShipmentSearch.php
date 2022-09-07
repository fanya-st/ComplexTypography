<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ShipmentSearch extends Shipment
{
    public static function tableName()
    {
        return 'shipment';
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','manager_id'], 'integer'],
            [['date_of_send','date_of_create'], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Shipment::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'date_of_send' => SORT_ASC,
            ],
            'attributes' => [
                'date_of_create',
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'date_of_send' => [
                    'asc' => ['date_of_send' => SORT_ASC],
                    'desc' => ['date_of_send' => SORT_DESC],
                ],
                ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['manager_id' => $this->manager_id]);
        if(isset ($this->date_of_create)&&$this->date_of_create!=''){
            $date_explode=explode(" | ",$this->date_of_create);
            $date1=trim($date_explode[0]);
            $date2=trim($date_explode[1]);
            if($date1!=$date2) {
                $query->andWhere("date_of_create BETWEEN str_to_date('$date1' ,'%d.%m.%Y %H-%i-%S') AND str_to_date('$date2' ,'%d.%m.%Y %H-%i-%S') ");
            }else{
                $query->andWhere("date_of_create BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
            }
        }
        if(isset ($this->date_of_send)&&$this->date_of_send!=''){
            $date_explode=explode(" | ",$this->date_of_send);
            $date1=trim($date_explode[0]);
            $date2=trim($date_explode[1]);
            if($date1!=$date2) {
                $query->andWhere("date_of_send BETWEEN str_to_date('$date1' ,'%d.%m.%Y %H-%i-%S') AND str_to_date('$date2' ,'%d.%m.%Y %H-%i-%S') ");
            }else{
                $query->andWhere("date_of_send BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
            }
        }
        return $dataProvider;
    }
}