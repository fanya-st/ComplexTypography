<?php
use yii\bootstrap5\Html;
?>
    <div class="p-3">
        <?php echo  Html::a('Внести изменения', ['material/update','id'=>$material->id], ['class'=>'btn btn-primary'])?>
    </div>
<div class="row g-2 row-cols-2">
    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-info p-1 rounded">Характеристики</h6>
            <?php if($material->status==0):?>
                <?php echo  Html::tag('h6','Статус: В архиве')?>
            <?php else:?>
                <?php echo  Html::tag('h6','Статус: Активный')?>
            <?php endif?>
            <?php echo  Html::tag('h6','Тип: ' .Html::encode($material->materialGroup->name))?>
            <?php echo  Html::tag('h6','Дата добавления: ' .Html::encode($material->date_of_create))?>
            <?php echo  Html::tag('h6','Краткое наименование: ' .Html::encode($material->short_name))?>
            <?php echo  Html::tag('h6','Подсказка: ' .Html::encode($material->prompt))?>
            <?php echo  Html::tag('h6','Поставщик: ' .Html::encode($material->materialProvider->name))?>
            <?php echo  Html::tag('h6','Плотность, г/м2: ' .Html::encode($material->density))?>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-warning p-1 rounded">Цена</h6>
            <?php echo  Html::tag('h6','Цена евро/м2: ' .Html::encode($material->price_euro))?>
        </div>
    </div>
</div>