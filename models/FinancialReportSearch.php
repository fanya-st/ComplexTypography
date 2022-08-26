<?php


namespace app\models;


use yii\base\Model;

class FinancialReportSearch extends FinancialReport
{
    public static function tableName()
    {
        return 'order';
    }

    public $date_of_print_start;
    public $date_of_print_end;
    public $label_id;
    public $mashine_id;
    public $pants_id;
    public $customer_id;
    public $manager_login;
    public $excel;

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['label_id','pants_id','mashine_id','customer_id','excel'], 'integer'],
            [['manager_login',], 'trim'],
            [['date_of_print_start','date_of_print_end'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date_of_print_start'=>'Дата печати заказа',
            'date_of_print_end'=>'Дата печати заказа',
            'label_id'=>'Этикетка',
            'mashine_id'=>'Станок',
            'customer_id'=>'Заказчик',
            'pants_id'=>'Штанец',
            'excel'=>'Выгрузить в Excel',
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $dataProvider = FinancialReport::find();
        // загружаем данные формы поиска и производим валидацию
        if ($this->load($params) && $this->validate()) {
            // изменяем запрос добавляя в его фильтрацию
            $dataProvider->andFilterWhere(['mashine_id' => $this->mashine_id]);
            $dataProvider->andFilterWhere(['label_id' => $this->label_id]);
            $dataProvider->andFilterWhere(['>=','date_of_print_end', date($this->date_of_print_start)]);
            $dataProvider->andFilterWhere(['<=','date_of_print_end', date($this->date_of_print_end)]);
            $dataProvider->andFilterWhere(['label_id' => $this->label_id]);
            $dataProvider->joinWith(['label.customer' => function ($q) {
                $q->andFilterWhere(['customer.id'=> $this->customer_id]);
                $q->andFilterWhere(['customer.manager_login'=> $this->manager_login]);
            }]);
            $dataProvider->joinWith(['label' => function ($q) {
                $q->andFilterWhere(['label.pants_id' => $this->pants_id]);
            }]);
            $orders = $dataProvider->all();
            foreach ($orders as $order) {
                $order->calculate();
            }
            if($this->excel==1){
                    FinancialReport::excel($orders,$this);
            }
            return $orders;
        }
    }
}