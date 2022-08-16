<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Штанцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pants-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    <pre>--><?//foreach($model->mashinePants as $temp)
//        print_r($temp->mashine);
//        ?><!--</pre>-->
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
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
                    'value'=>function($model){
                        foreach($model->mashinePants as $mashine){
                            $mashine_list.= $mashine->mashine->name.', ';
                        }
                        return $mashine_list;

                    },
            ],
            [
                'attribute'=>'knife_kind_id',
                'value'=>$model->knifeKind->name,
            ],
            'knife_width',
            [
                    'attribute'=>'picture',
                    'value'=>function($model){
                        return Html::img($model->picture,['alt'=>$model->name,'title'=>$model->name,'width'=>100]);
                    },
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
