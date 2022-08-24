<?php


namespace app\models;


use yii\helpers\ArrayHelper;

class MaterialMovement extends Material
{
    public $period_start;
    public $period_end;
    public $search_material_id;
    public $search_material_group_id;
    public $result;

    public static function tableName()
    {
        return 'material';
    }


    public function search($params)
    {
        $dataProvider = $this::find();
        // загружаем данные формы поиска и производим валидацию
        if ($this->load($params) && $this->validate()) {
            // изменяем запрос добавляя в его фильтрацию
            $dataProvider->andFilterWhere(['material_group_id' => $this->search_material_group_id]);
            $dataProvider->andFilterWhere(['id' => $this->search_material_id]);
            $items = $dataProvider->all();
            foreach ($items as $item) {
                if (!empty($this->period_start))
                    $item->period_start = $this->period_start;
                if (!empty($this->period_end))
                    $item->period_end = $this->period_end;
                $item->calculateMovement();
            }

            return $items;
        }
    }


    public function rules()
    {
        return [
            [['period_start', 'period_end'], 'required'],
            [['period_start', 'period_end', 'result', 'search_material_id', 'search_material_group_id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'search_material_id' => 'Материал',
            'search_material_group_id' => 'Группа',
            'period_start' => 'Начало',
            'period_end' => 'Конец',
        ];
    }


    public function CalculateMovement()
    {
        //приход в период выборки
        $paper_warehouse = PaperWarehouse::find()->select(['material_id', 'width', 'sum(length) as length'])
            ->andFilterWhere(['>=', 'date_of_create', date($this->period_start)])
            ->andFilterWhere(['<=', 'date_of_create', date($this->period_end)])
            ->andWhere(['material_id' => $this->id])
            ->groupBy(['material_id', 'width'])->asArray()->all();
        foreach ($paper_warehouse as $paper) {
            ArrayHelper::setValue($this->result, $paper['width'].'.incoming', $paper['length']);
            //общая длина прихода
            $incoming_length+=$paper['length'];
        }
        //расход в период выборки
        $order_material = OrderMaterial::find()->select(['material.id', 'paper_warehouse.width', 'sum(order_material.length) as length'])
            ->joinWith('paperWarehouse.material')
            ->andFilterWhere(['>=', 'order_material.date', date($this->period_start)])
            ->andFilterWhere(['<=', 'order_material.date', date($this->period_end)])
            ->andWhere(['material.id' => $this->id])
            ->groupBy(['material.id', 'paper_warehouse.width'])->asArray()->all();
        foreach ($order_material as $paper) {
            ArrayHelper::setValue($this->result, $paper['width'].'.usage', $paper['length']);
            //общая длина расхода
            $usage_length+=$paper['length'];
        }

        //сальдо на конец периода выборки
        $saldo=StockOnHandPaper::findOne($this->id);
        $saldo->date=$this->period_end;
        $saldo->stockOnHand();
        if (!empty($saldo->result))
        foreach ($saldo->result as $key=>$value) {
            if($key !='square'){
                ArrayHelper::setValue($this->result, $key.'.saldo', $value['on_date']);
                //общая длина сальдо
                $saldo_length+=$value['on_date'];
            }
        }
        ArrayHelper::setValue($this->result, 'summary.saldo', $saldo_length);
        ArrayHelper::setValue($this->result, 'summary.usage', $usage_length);
        ArrayHelper::setValue($this->result, 'summary.incoming', $incoming_length);

    }
}