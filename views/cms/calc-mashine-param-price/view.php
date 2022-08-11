<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;


$this->title = $model->calcMashineParam->subscribe;
$this->params['breadcrumbs'][] = ['label' => 'Calc Mashine Param Prices', 'url' => ['calc-mashine-param-price-index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="calc-mashine-param-price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['calc-mashine-param-price-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['calc-mashine-param-price-delete', 'id' => $model->id], [
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
            'id',
            [
                    'attribute'=>'mashine_id',
                    'value'=>$model->mashine->name,
            ],

            [
                    'attribute'=>'calc_mashine_param_id',
                    'value'=>$model->calcMashineParam->subscribe,
            ],
            'value',
            'date',
        ],
    ]) ?>

</div>
