<?php


namespace app\models;
use yii\helpers\ArrayHelper;

class StockOnHandPaper extends Material
{
    public static function tableName()
    {
        return 'material';
    }

    public $date;
    public $result;
    public $search_material_id;
    public $search_material_group_id;

    public function attributeLabels()
    {
        return [
            'search_material_id' => 'Материал',
            'search_material_group_id' => 'Группа',
            'date' => 'Выбрать дату',
        ];
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
                if (!empty($this->date))
                    $item->date = $this->date;
                $item->stockOnHand();
            }

            return $items;
        }
    }

    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date','result','search_material_group_id','search_material_id'], 'safe'],
        ];
    }

    public function StockOnHand(){

        //текущие запасы
        $paper_warehouse = PaperWarehouse::find()->select(['material_id', 'width', 'sum(length) as length'])
            ->andWhere(['material_id' => $this->id])
            ->groupBy(['material_id', 'width'])->asArray()->all();
        foreach ($paper_warehouse as $paper) {
            ArrayHelper::setValue($this->result, $paper['width'].'.now', $paper['length']);
        }
        //приход в период выборки
        $paper_warehouse = PaperWarehouse::find()->select(['material_id', 'width', 'sum(length) as length'])
            ->andFilterWhere(['>=', 'date_of_create', date($this->date)])
            ->andWhere(['material_id' => $this->id])
            ->groupBy(['material_id', 'width'])->asArray()->all();
        foreach ($paper_warehouse as $paper) {
            ArrayHelper::setValue($this->result, $paper['width'].'.incoming', $paper['length']);
        }
        //расход в периода выборки
        $order_material = OrderMaterial::find()->select(['material.id', 'paper_warehouse.width', 'sum(order_material.length) as length'])
            ->joinWith('paperWarehouse.material')
            ->andFilterWhere(['>=', 'order_material.date', date($this->date)])
            ->andWhere(['material.id' => $this->id])
            ->groupBy(['material.id', 'paper_warehouse.width'])->asArray()->all();
        foreach ($order_material as $paper) {
            ArrayHelper::setValue($this->result, $paper['width'].'.usage', $paper['length']);
        }
        if(!empty($this->result))
        foreach($this->result as $key=>$value){
            ArrayHelper::setValue($this->result, $key.'.on_date', $value['now']-$value['incoming']+$value['usage']);
            ArrayHelper::setValue($this->result, $key.'.square', round(($this->result[$key]['on_date'])*$key/1000,3));
            $square+=$this->result[$key]['square'];
        }
        ArrayHelper::setValue($this->result, 'square',$square);
    }

}