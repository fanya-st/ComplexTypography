<?php
use yii\bootstrap5\Html;
?>
<!--<pre>--><?//print_r($material_warehouse)?><!--</pre>-->

<div class="border p-2 rounded">
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
        <?foreach ($material_warehouse as $material):?>
            <tr>
                <td><?=Html::encode($material->material->name)?></td>
                <td><?=Html::encode($material->width)?></td>
                <td><?=Html::encode($material->length)?></td>
                <td><?=Html::encode($material->length*$material->width/1000);$summary+=$material->length*$material->width/1000;?></td>
            </tr>
        <?endforeach;?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Итого: <?=$summary?> м<sup>2</sup></td>
        </tr>
        </tbody>
    </table>
</div>