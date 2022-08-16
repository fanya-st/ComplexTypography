<?php


namespace app\models;
use yii;


class PaperWarehouseRollCut extends PaperWarehouse
{
    public static function tableName()
    {
        return 'paper_warehouse';
    }

    public $paper_warehouse_id;
    public $id1;
    public $id2;
    public $roll_cut_width1;
    public $roll_cut_length1;
    public $roll_cut_width2;
    public $roll_cut_length2;

    public function attributeLabels()
    {
        return [
            'paper_warehouse_id'=>'ID ролика',
            'roll_cut_width1'=>'Ширина ролика 1',
            'roll_cut_width2'=>'Ширина ролика 2',
            'roll_cut_length1'=>'Длина ролика 1',
            'roll_cut_length2'=>'Длина ролика 2',
        ];
    }

    public function rules(){
        return[
            [['paper_warehouse_id','roll_cut_width1','roll_cut_length1','roll_cut_width2','roll_cut_length2','id1','id2'],'integer'],
            [['paper_warehouse_id','roll_cut_width1','roll_cut_length1','roll_cut_width2','roll_cut_length2'],'required'],
        ];
    }

    public function rollcut(){

            $paper_warehouse=PaperWarehouse::findOne($this->paper_warehouse_id);
            if($paper_warehouse->width == ($this->roll_cut_width1+$this->roll_cut_width2)){
                if($paper_warehouse->length > $this->roll_cut_length1 AND $paper_warehouse->length > $this->roll_cut_length2){
                    $roll1=new PaperWarehouse();
                    $roll1->material_id=$paper_warehouse->material_id;
                    $roll1->length=$this->roll_cut_length1;
                    $roll1->width=$this->roll_cut_width1;
                    if($roll1->save()) $this->id1=$roll1->id;


                    $roll2=new PaperWarehouse();
                    $roll2->material_id=$paper_warehouse->material_id;
                    $roll2->length=$this->roll_cut_length2;
                    $roll2->width=$this->roll_cut_width2;
                    if($roll2->save()) $this->id2=$roll2->id;


                    if($this->roll_cut_length1 >= $this->roll_cut_length2){
                        $paper_warehouse->length-=$this->roll_cut_length1;
                    }else{
                        $paper_warehouse->length-=$this->roll_cut_length2;
                    }
                    if($paper_warehouse->save()){
                        Yii::$app->session->setFlash('success', 'Ролик разрезан');
                        return true;
                    }
                    else{
                        Yii::$app->session->setFlash('error', 'Ошибка');
                        return false;
                    }
                }else{
                    Yii::$app->session->setFlash('error', 'Нет необходимой длины');
                    return false;
                }


            }else {
                Yii::$app->session->setFlash('error', 'Ширина новых роликов больше чем исходный ролик');
                return false;
            }


    }
}