<?php


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class StockOnHandPaperSearch extends MaterialSearch
{
    public static function tableName()
    {
        return 'material';
    }

    public $stock_date;

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['id','material_group_id'], 'integer'],
            [['stock_date'], 'safe'],
        ];
    }
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query=StockOnHandPaper::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['material_group_id' => $this->material_group_id]);
        $query->andFilterWhere(['id' => $this->id]);
        return $dataProvider;
    }
}