<?php


namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


class MaterialSearch extends Material
{
    public static function tableName()
    {
        return 'material';
    }
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['density','id','material_group_id','material_provider_id','status'], 'integer'],
            [['name','short_name','prompt'], 'trim'],
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
        $query=Material::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'date_of_create' => SORT_DESC,
            ],
            'attributes' => [
                'date_of_create',
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
            ]
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['material_group_id' => $this->material_group_id]);
        $query->andFilterWhere(['density' => $this->density]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'short_name', $this->short_name]);
        $query->andFilterWhere(['material_provider_id' => $this->material_provider_id]);
        return $dataProvider;
    }

}