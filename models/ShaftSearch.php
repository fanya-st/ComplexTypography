<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shaft;

/**
 * ShaftSearch represents the model behind the search form of `app\models\Shaft`.
 */
class ShaftSearch extends Shaft
{
    public static function tableName()
    {
        return 'shaft';
    }

    public function rules()
    {
        return [
            [['id', 'polymer_kind_id'], 'integer'],
            [['name'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Shaft::find();

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
            'id' => $this->id,
            'name' => $this->name,
            'polymer_kind_id' => $this->polymer_kind_id,
        ]);

        return $dataProvider;
    }
}
