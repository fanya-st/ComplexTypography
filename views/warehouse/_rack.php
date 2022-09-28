<?php
use yii\bootstrap5\Html;
use yii\web\YiiAsset;
YiiAsset::register($this);

/** @var \app\models\Rack $rack */
/** @var \app\models\Shelf $shelfs */

$this->title = $rack->name;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?php echo  Html::encode($this->title)?> <?php echo  Html::a('QR-код', ['warehouse/qr-print-rack','id'=>$rack->id], ['class' => 'btn btn-primary btn-sm','target'=>'_blank']) ?></h1>

<div class="d-lg-flex flex-wrap">
    <?php foreach ($shelfs as $shelf):?>
    <div class="border p-3 rounded m-1">
        <h6 class="p-1 rounded text-wrap">Полка <?php echo $shelf->id?></h6>
        <div class="p-1"><?php echo  Html::a('Открыть', ['warehouse/shelf-list','id'=>$shelf->id], ['class' => 'btn btn-primary btn-sm']) ?></div>
        <div class="p-1"><?php echo  Html::a('QR-код', ['warehouse/qr-print-shelf','id'=>$shelf->id], ['class' => 'btn btn-primary btn-sm','target'=>'_blank']) ?></div>
    </div>
    <?php endforeach;?>
</div>
