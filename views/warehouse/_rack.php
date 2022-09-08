<?php

use yii\bootstrap5\Html;

$this->title = 'Стеллаж '.$rack->name;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row g-2 row-cols-lg-4 text-nowrap">
    <?foreach ($shelfs as $shelf):?>
        <div class="col-lg">
            <div class="border p-3 rounded">
                <h6 class="p-1 rounded text-wrap">Полка <?=$shelf->id?></h6>
                <div class="d-lg-flex flex-wrap">
                    <ul class="list-group text-wrap">

                        <?if(!empty($shelf->paperWarehouse)) foreach($shelf->paperWarehouse as $paper):?>
                            <li class="list-group-item"><?=$paper->material->name.' '.$paper->width.'мм '.$paper->length.'м'?></li>
                        <?endforeach;?>

                        <? if(!empty($shelf->envelope)) foreach($shelf->envelope as $envelope):?>
                            <li class="list-group-item">Конверт <?=$envelope->idWithColor?></li>
                        <?endforeach;?>

                        <? if(!empty($shelf->pantoneWarehouse)) foreach($shelf->pantoneWarehouse as $pantone):?>
                            <li class="list-group-item">ЛКМ <?=$pantone->pantone->name.' '.$pantone->weight.'кг'?></li>
                        <?endforeach;?>
                    </ul>

                </div>
            </div>
        </div>
    <?endforeach;?>
</div>

<pre><?print_r($data)?></pre>
