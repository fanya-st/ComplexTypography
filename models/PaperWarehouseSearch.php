<?php


namespace app\models;

use yii\data\ActiveDataProvider;
use yii\base\Model;

class PaperWarehouseSearch extends PaperWarehouse
{

    public $materialGroupId;
    public $materialName;
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
            [['id','material_id','length','width','materialGroupId','width_from','width_to'], 'integer'],
            [['length','width','materialName','width_from','width_to'], 'trim'],
            [[], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query=PaperWarehouse::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
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

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['paper_warehouse.id' => $this->id]);
        $query->andFilterWhere(['like','material.name',$this->materialName]);
        $query->joinWith(['material' => function ($q) {
            $q->andFilterWhere(['material.material_group_id' => $this->materialGroupId]);
        }]);
        $query->andFilterWhere(['length' => $this->length]);
        $query->andFilterWhere(['between', 'width', $this->width_from, $this->width_to]);
//        $query->andFilterWhere(['like', 'short_name', $this->short_name]);
//        $query->andFilterWhere(['material_provider_id' => $this->material_provider_id]);
        return $dataProvider;
    }
}