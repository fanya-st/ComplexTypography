<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BankTransfer;


class BankTransferSearch extends BankTransfer
{
    public static function tableName()
    {
        return 'bank_transfer';
    }

    public $manager_id;

    public function rules()
    {
        return [
            [['id', 'customer_id','manager_id'], 'integer'],
            [['date_of_create', 'date'], 'safe'],
            [['sum'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BankTransfer::find();

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
            'bank_transfer.id' => $this->id,
            'bank_transfer.date_of_create' => $this->date_of_create,
            'bank_transfer.customer_id' => $this->customer_id,
            'bank_transfer.sum' => $this->sum,
        ]);
        if(!empty($this->date)){
            $date_explode=explode(" - ",$this->date);
            $date1=trim($date_explode[0]);
            $date2=trim($date_explode[1]);
            $query->andFilterWhere(
                ['between','bank_transfer.date',date_format(date_create($date1)->modify('-1 day'),"Y-m-d H:i:s"),date_format(date_create($date2)->modify('+1 day'),"Y-m-d H:i:s")]
            );
        }
        $query->joinWith(['customer' => function ($q) {
            $q->andFilterWhere(['customer.user_id'=> $this->manager_id]);
        }]);

        return $dataProvider;
    }
}
