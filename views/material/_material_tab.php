<?php
use yii\bootstrap5\Html;
?>
    <div class="p-3">
        <?=Html::a('Внести изменения', ['material/update','id'=>$material->id], ['class'=>'btn btn-primary'])?>
    </div>
<div class="row g-2 row-cols-2">
    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-info p-1 rounded">Характеристики</h6>
            <?if($material->status==0):?>
                <?=Html::tag('h6','Статус: В архиве')?>
            <?else:?>
                <?=Html::tag('h6','Статус: Активный')?>
            <?endif?>
            <?=Html::tag('h6','Тип: ' .Html::encode($material->materialGroup->name))?>
            <?=Html::tag('h6','Дата добавления: ' .Html::encode($material->date_of_create))?>
            <?=Html::tag('h6','Краткое наименование: ' .Html::encode($material->short_name))?>
            <?=Html::tag('h6','Подсказка: ' .Html::encode($material->prompt))?>
            <?=Html::tag('h6','Поставщик: ' .Html::encode($material->materialProvider->name))?>
            <?=Html::tag('h6','Плотность, г/м2: ' .Html::encode($material->density))?>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-warning p-1 rounded">Цена</h6>
            <?=Html::tag('h6','Цена в рублях за м2: ' .Html::encode($material->price_rub))?>
            <?=Html::tag('h6','Цена в рублях за м2 со скидкой: ' .Html::encode($material->price_rub_discount))?>
            <?=Html::tag('h6','Цена в евро за м2: ' .Html::encode($material->price_euro))?>
            <?=Html::tag('h6','Цена в евро за м2 со скидкой: ' .Html::encode($material->price_euro_discount))?>
        </div>
    </div>
</div>