<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pants;

/**
 * PantsSearch represents the model behind the search form of `app\models\Pants`.
 */
class PantsSearch extends Pants
{
    public static function tableName()
    {
        return 'pants';
    }


    public function rules()
    {
        return [
            [['id', 'shaft_id', 'paper_width', 'pants_kind_id', 'cuts', 'knife_kind_id', 'knife_width', 'material_group_id'], 'integer'],
            [['name', 'picture'], 'safe'],
            [['width_label', 'height_label', 'radius', 'gap'], 'number'],
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
        $query = Pants::find();

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
            'shaft_id' => $this->shaft_id,
            'paper_width' => $this->paper_width,
            'pants_kind_id' => $this->pants_kind_id,
            'cuts' => $this->cuts,
            'width_label' => $this->width_label,
            'height_label' => $this->height_label,
            'knife_kind_id' => $this->knife_kind_id,
            'knife_width' => $this->knife_width,
            'radius' => $this->radius,
            'gap' => $this->gap,
            'material_group_id' => $this->material_group_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
