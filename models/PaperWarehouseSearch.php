<?php


namespace app\models;

use yii\data\ActiveDataProvider;
use yii\base\Model;

class PaperWarehouseSearch extends PaperWarehouse
{

    public $material_group_id;
    public $width_from;
    public $width_to;
    public static function tableName()
    {
        return 'paper_warehouse';
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','material_id','length','material_group_id','width_from','width_to'], 'integer'],
            [['id','material_id','length','material_group_id','width_from','width_to'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'width_from'=>'Ширина от, мм',
            'width_to'=>'Ширина до, мм',
            'length'=>'Длина, м',
            'id'=>'ID',
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query=PaperWarehouse::find()->where(['>','length',0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ]
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'id' => SORT_DESC,
            ],
            'attributes' => [
                'date_of_create',
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
//                'materialName' => [
//                    'asc' => ['material.name' => SORT_ASC],
//                    'desc' => ['material.name' => SORT_DESC],
//                ],
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->joinWith(['material' => function ($q) {
            $q->andFilterWhere([
                'material.material_group_id' => $this->material_group_id,
            ]);
        }]);
        $query->andFilterWhere([
            'length' => $this->length,
            'paper_warehouse.id' => $this->id,
            'material_id'=>$this->material_id
        ]);
        $query->andFilterWhere(['between', 'width', $this->width_from, $this->width_to]);
        return $dataProvider;
    }
}