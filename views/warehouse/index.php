<?php
use yii\bootstrap5\Html;

/** @var \app\models\Warehouse $data */

$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?php echo  Html::encode($this->title) ?></h1>

<div class="row g-2 row-cols-lg-4 text-nowrap">
    <?php foreach ($data as $warehouse):?>
    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded text-wrap"><?php echo $warehouse->name?></h6>
            <div class="d-lg-flex flex-wrap">
                <?php foreach($warehouse->rack as $rack):?>
                <div class="p-1"><?php echo  Html::a($rack->name, ['warehouse/rack-list','id'=>$rack->id], ['class' => 'btn btn-primary']) ?></div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>