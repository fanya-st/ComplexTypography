<?php

use yii\bootstrap5\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;


$this->title = 'Штанец №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Штанцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pants-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<!--    <pre>--><?//print_r($model)?><!--</pre>-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'attribute'=>'shaft_id',
                    'value'=>$model->shaft->name,
            ],
            'paper_width',

            [
                'attribute'=>'pants_kind_id',
                'value'=>$model->pantsKind->name,
            ],
            'cuts',
            'width_label',
            'height_label',
            [
                    'label'=>'Совместимость',
                'displayOnly'=>true,
                    'value'=>call_user_func(function($model){
                        foreach($model->mashinePants as $mashine){
                            $mashine_list.= $mashine->mashine->name.', ';
                        }
                        return $mashine_list;

                    },$model),
            ],
            [
                'attribute'=>'knife_kind_id',
                'value'=>$model->knifeKind->name,
            ],
            'knife_width',
            [
                    'attribute'=>'picture',
                    'displayOnly'=>true,
                    'value'=>call_user_func(function($model){
                        return Html::img($model->picture,['alt'=>$model->id,'title'=>$model->id,'width'=>100]);
                    },$model),
                    'format'=>'raw',
            ],

            'radius',
            'gap',

            [
                'attribute'=>'material_group_id',
                'value'=>$model->materialGroup->name,
            ],
        ],
    ]) ?>

</div>
