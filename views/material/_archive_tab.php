<?php
use yii\bootstrap5\Html;
?>
<div class="border p-2 rounded">
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Параметр</th>
            <th scope="col">Материал</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Значение</th>
        </tr>
        </thead>
        <tbody>
        <?foreach ($material->materialPriceArchive as $materialPriceArchive):?>
            <tr>
                <td><?=Html::encode($material->getAttributeLabel($materialPriceArchive->price_attribute))?></td>
                <td><?=Html::encode($material->name)?></td>
                <td><?=Html::encode($materialPriceArchive->date_of_change)?></td>
                <td><?=Html::encode($materialPriceArchive->old_value)?></td>
            </tr>
        <?endforeach;?>
        </tbody>
    </table>
    </div>
</div>
