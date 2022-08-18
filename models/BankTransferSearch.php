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

    public $manager_login;

    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['date_of_create', 'date'], 'safe'],
            [['sum'], 'number'],
            [['manager_login'], 'string'],
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
                ['>=','bank_transfer.date',date($date1)]
            );
            $query->andFilterWhere(
                ['<=','bank_transfer.date',date($date2)]
            );
        }
        $query->joinWith(['customer' => function ($q) {
            $q->andFilterWhere(['customer.manager_login'=> $this->manager_login]);
        }]);

        return $dataProvider;
    }
}
