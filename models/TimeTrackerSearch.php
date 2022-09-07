<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;


class TimeTrackerSearch extends TimeTracker
{
    public $role;
    public static function tableName()
    {
        return 'time_tracker';
    }

    public function rules()
    {
        return [
            [['role'], 'string'],
            [['employee_id'], 'integer'],
            [['role'], 'trim'],
            [['date_of_action'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TimeTracker::find();

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
            'employee_id' => $this->employee_id,
        ]);
        if(!empty($this->role)){
            $user_list_id=Yii::$app->authManager->getUserIdsByRole($this->role);
//            foreach($user_list_id as $user_id){
//                $user_column[]=User::findIdentity($user_id)->getId();
//            }
            $query->andFilterWhere([
                'employee_id' => $user_list_id,
        ]);
        }



        if(!empty($this->date_of_action)){
            $date_explode=explode(" - ",$this->date_of_action);
            $date1=trim($date_explode[0]);
            $date2=trim($date_explode[1]);
            $query->andFilterWhere(
                ['between','date_of_action',date_format(date_create($date1)->modify('-1 day'),"Y-m-d H:i:s"),date_format(date_create($date2)->modify('+1 day'),"Y-m-d H:i:s")]
            );
        }

        $query->orderBy([
            'id' => SORT_ASC,
        ]);

        return $dataProvider;
    }
}
