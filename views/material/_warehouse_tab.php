<?php
use yii\bootstrap5\Html;
?>

<div class="border p-2 rounded">
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Ширина, мм</th>
            <th scope="col">Общая длина, м</th>
            <th scope="col">Кв, м<sup>2</sup></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($material_warehouse as $material):?>
            <tr>
                <td><?php echo  Html::encode($material->material->name)?></td>
                <td><?php echo  Html::encode($material->width)?></td>
                <td><?php echo  Html::encode($material->length)?></td>
                <td><?php echo  Html::encode($material->length*$material->width/1000);$summary+=$material->length*$material->width/1000;?></td>
            </tr>
        <?php endforeach;?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Итого: <?php echo !empty($summary) ? $summary:0 ?> м<sup>2</sup></td>
        </tr>
        </tbody>
    </table>
</div>
</div>