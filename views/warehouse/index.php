<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;

$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row g-2 row-cols-lg-4 text-nowrap">
    <?foreach ($data as $warehouse):?>
    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded text-wrap"><?=$warehouse->name?></h6>
            <div class="d-lg-flex flex-wrap">
                <?foreach($warehouse->rack as $rack):?>
                <div class="p-1"><?= Html::a($rack->name, ['warehouse/rack-list','id'=>$rack->id], ['class' => 'btn btn-primary']) ?></div>
                <?endforeach;?>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>