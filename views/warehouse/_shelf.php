<?php

use yii\bootstrap5\Html;

/** @var \app\models\Shelf $shelf */
/** @var \app\models\Rack $rack */

$this->title = 'Полка №'.$shelf->id;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse/index']];

$this->params['breadcrumbs'][] = ['label' => $rack->name, 'url' => ['warehouse/rack-list','id'=>$rack->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?php echo  Html::encode($this->title)?> <?php echo  Html::a('QR-код', ['warehouse/qr-print-rack','id'=>$rack->id], ['class' => 'btn btn-primary btn-sm','target'=>'_blank']) ?></h1>

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
    <?php if(!empty($shelf->paperWarehouse)) foreach($shelf->paperWarehouse as $paper):?>
        <tr>
            <th><?php echo $paper->id?></th>
            <td><?php echo $paper->material->name?></td>
            <td><?php echo $paper->length?></td>
            <td><?php echo $paper->width?></td>
        </tr>
    <?php endforeach;?>

    <?php if(!empty($shelf->envelope)) foreach($shelf->envelope as $envelope):?>
        <tr>
            <th><?php echo $envelope->id?></th>
            <td><?php echo $envelope->idWithColor?></td>
            <td>-</td>
            <td>-</td>
        </tr>
    <?php endforeach;?>

    <?php if(!empty($shelf->pantoneWarehouse)) foreach($shelf->pantoneWarehouse as $pantone):?>
        <tr>
            <th><?php echo $pantone->id?></th>
            <td><?php echo $pantone->pantone->name?></td>
            <td><?php echo $pantone->weight?></td>
            <td>-</td>
        </tr>
    <?php endforeach;?>

    </tbody>
</table>

