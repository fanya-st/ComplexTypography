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

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [[], 'integer'],
            [['name'], 'trim'],
            [['id','name','manager_login','designer_login','customer_id','pants_id','shaft_id','status_id','date_of_create'], 'safe'],
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
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['designer_login'=> $this->designer_login]);
        $query->andFilterWhere(['manager_login'=> $this->manager_login]);
        $query->andFilterWhere(['customer_id'=> $this->customer_id]);
        $query->andFilterWhere(['shaft_id'=> $this->shaft_id]);
        $query->andFilterWhere(['pants_id'=> $this->pants_id]);
        $query->andFilterWhere(['status_id'=> $this->status_id]);
            if(isset ($this->date_of_create)&&$this->date_of_create!=''){
                $date_explode=explode(" - ",$this->date_of_create);
                $date1=trim($date_explode[0]);
                $date2=trim($date_explode[1]);
                if($date1!=$date2) {
                    $query->andWhere("date_of_create BETWEEN str_to_date('$date1' ,'%d.%m.%Y %H-%i-%S') AND str_to_date('$date2' ,'%d.%m.%Y %H-%i-%S') ");
                }else{
                    $query->andWhere("date_of_create BETWEEN str_to_date('".$date1." 00-00-00','%d.%m.%Y %H-%i-%S') AND str_to_date('".$date2." 23-59-59','%d.%m.%Y %H-%i-%S') ");
                }
            }
        return $dataProvider;
    }
}