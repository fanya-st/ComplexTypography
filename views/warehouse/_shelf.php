<?php

use yii\bootstrap5\Html;

$this->title = 'Полка №'.$shelf->id;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse/index']];
$this->params['breadcrumbs'][] = ['label' => $rack->name, 'url' => ['warehouse/rack-list','id'=>$rack->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title)?> <?= Html::a('QR-код', ['warehouse/qr-print-rack','id'=>$rack->id], ['class' => 'btn btn-primary btn-sm','target'=>'_blank']) ?></h1>
<!--<div class="row g-2 row-cols-lg-4 text-nowrap">-->
<!--    --><?//foreach ($shelfs as $shelf):?>
<!--        <div class="col-lg">-->
<!--            <div class="border p-3 rounded">-->
<!--                <h6 class="p-1 rounded text-wrap">Полка --><?//=$shelf->id?><!-- --><?//= Html::a('QR-код', ['warehouse/qr-print-shelf','id'=>$shelf->id], ['class' => 'btn btn-primary btn-sm','target'=>'_blank']) ?><!--</h6>-->
<!--                <div class="d-lg-flex flex-wrap">-->
<!--                    <ul class="list-group text-wrap">-->
<!---->
<!--                        --><?//if(!empty($shelf->paperWarehouse)) foreach($shelf->paperWarehouse as $paper):?>
<!--                            <li class="list-group-item">--><?//=$paper->material->name.' '.$paper->width.'мм '.$paper->length.'м'?><!--</li>-->
<!--                        --><?//endforeach;?>
<!---->
<!--                        --><?// if(!empty($shelf->envelope)) foreach($shelf->envelope as $envelope):?>
<!--                            <li class="list-group-item">Конверт --><?//=$envelope->idWithColor?><!--</li>-->
<!--                        --><?//endforeach;?>
<!---->
<!--                        --><?// if(!empty($shelf->pantoneWarehouse)) foreach($shelf->pantoneWarehouse as $pantone):?>
<!--                            <li class="list-group-item">ЛКМ --><?//=$pantone->pantone->name.' '.$pantone->weight.'кг'?><!--</li>-->
<!--                        --><?//endforeach;?>
<!--                    </ul>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    --><?//endforeach;?>
<!--</div>-->

<table class="table table-responsive">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Наименование</th>
        <th scope="col">Количество ,(кг,м)</th>
        <th scope="col">Ширина, мм</th>
    </tr>
    </thead>
    <tbody>
    <?if(!empty($shelf->paperWarehouse)) foreach($shelf->paperWarehouse as $paper):?>
        <tr>
            <th><?=$paper->id?></th>
            <td><?=$paper->material->name?></td>
            <td><?=$paper->length?></td>
            <td><?=$paper->width?></td>
        </tr>
    <?endforeach;?>

    <? if(!empty($shelf->envelope)) foreach($shelf->envelope as $envelope):?>
        <tr>
            <th><?=$envelope->id?></th>
            <td><?=$envelope->idWithColor?></td>
            <td>-</td>
            <td>-</td>
        </tr>
    <?endforeach;?>

    <? if(!empty($shelf->pantoneWarehouse)) foreach($shelf->pantoneWarehouse as $pantone):?>
        <tr>
            <th><?=$pantone->id?></th>
            <td><?=$pantone->pantone->name?></td>
            <td><?=$pantone->weight?></td>
            <td>-</td>
        </tr>
    <?endforeach;?>

    </tbody>
</table>

