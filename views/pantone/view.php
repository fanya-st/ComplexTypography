<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пантоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pantone-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'id',
            'name',
            [
                    'attribute'=>'pantone_kind_id',
                    'value'=>$model->pantoneKind->name,
            ],
            'price_rub',
            'price_rub_discount',
            'price_euro',
            'price_euro_discount',
            'subscribe',
            [
                    'attribute'=>'mashine_list',
                    'value'=>function($model){
                        foreach ($model->mashine as $mashine){
                            $list.=$mashine->name.', ';
                        }
                        return $list;
                    },
            ],


        ],
    ]) ?>
    <?if(!empty($model->mixedPantone)):?>
    <div class="row">
        <div class="col">
            <table class="table table-bordered rounded table-sm caption-top">
                <caption>Состав смешанного PANTONE</caption>
                <thead>
                <tr class="text-center">
                    <th scope="col">PANTONE</th>
                    <th scope="col">Вес</th>
                </tr>
                </thead>
                <tbody>
                <?foreach($model->mixedPantone as $mixed_pantone):?>
                    <?if(!empty($mixed_pantone->component_pantone_id)):?>
                        <tr class="text-center">
                            <th><?=$mixed_pantone->pantone->name?></th>
                            <td><?=$mixed_pantone->weight?></td>
                        </tr>
                    <?endif;?>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col"></div>
    </div>

    <?endif;?>

</div>
