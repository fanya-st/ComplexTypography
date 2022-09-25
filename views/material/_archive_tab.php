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
        <?php foreach ($material->materialPriceArchive as $materialPriceArchive):?>
            <tr>
                <td><?php echo  Html::encode($material->name)?></td>
                <td><?php echo  Html::encode($materialPriceArchive->date_of_change)?></td>
                <td><?php echo  Html::encode($materialPriceArchive->old_value)?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
