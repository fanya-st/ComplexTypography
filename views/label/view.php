<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

$this->title = Html::encode("ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title);
    if(isset($label->parent_label)){
        echo Html::a('[Изменение этикетки №'.$label->parent_label.']', ['label/view', 'id' => $label->parent_label]);
    }?></h3>
<!--<pre>--><?//print_r($nav_items)?><!--</pre>-->
<?
echo Nav::widget([
//    'items' => [
//        ['label' => 'Дизайнер', 'items' => [
//            ['label' => 'Внести изменения', 'url' => ['label/update','id'=>Html::encode($label->id)]],
//            ['label' => 'Создать дизайн', 'url' => ['label/create-design','id'=>Html::encode($label->id)]],
//        ],
//        ],
//        ['label' => 'Менеджер', 'items' => [
//            ['label' => 'Внести изменения', 'url' => ['label/update','id'=>Html::encode($label->id)]],
//            ['label' => 'Создать подобную', 'url' => ['label/create']],
//            ['label' => 'Заказ в печать..', 'url' => ['order/create','label_id'=>Html::encode($label->id),'blank'=>0]],
//        ],
//        ],
//        ['label' => 'Prepress', 'items' => [
//            ['label' => 'Внести изменения', 'url' => ['label/update','id'=>Html::encode($label->id)]],
//        ],
//        ],
//    ],
    'items' => $nav_items,
    'options' => ['class' => 'nav'],
]);?>
<div class="row">
    <div class="col">
        <?= Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'500px']),$label->image,['target'=>'_blank'])?>
        <?= Html::a('Доп.файл',$label->image_extended,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
        <?= Html::a('Файл дизайна',$label->design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
        <?= Html::a('Файл дизайна Prepress',$label->prepress_design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>

    </div>
    <div class="col">
        <h6>Статус этикетки: <small class="badge bg-primary"><?=Html::encode($label->labelStatusName)?></small> </h6>
        <h6>Заказчик: <small><?=Html::encode($label->customerName)?></small> </h6>
        <h6>Дата создания: <small><?=Html::encode($label->date_of_create)?></small> </h6>
        <h6>Дата Prepress: <small><?=Html::encode($label->date_of_prepress)?></small> </h6>
        <h6>Штанец: <small><?=Html::encode($label->pantsName)?></small> Вал: <small><?=Html::encode($label->shaftName)?></small></h6>
        <h6>Количество форм: <small><?=Html::encode($label->formCount)?></small></h6>
        <h6>Пантоны: <? foreach ($label->pantone as $pantone) echo '<span class="badge bg-primary">'.$pantone->name.'</span>'?></h6>
        <h6>Фольга: <small><?=Html::encode($label->foilName)?></small> </h6>
        <h6>Вид лака: <small><?=Html::encode($label->varnishStatusName)?></small> </h6>
        <h6>Ламинация: <small class="badge bg-secondary"><?=Html::encode($label->laminateName)?></small> Трафарет: <small class="badge bg-secondary"><?=Html::encode($label->stencilName)?></small></h6>
        <h6>Перем.печать: <small class="badge bg-secondary"><?=Html::encode($label->variableName)?></small> Печать по клею: <small class="badge bg-secondary"><?=Html::encode($label->printOnGlueName)?></small> </h6>
        <h6 class="badge badge-primary"><?=Html::encode($label->fullCMYK)?></h6>
    </div>
    <div class="col">
        <h6>Дизайнер: <small><?=Html::encode($label->fullName)?></small> </h6>
        <h6>Менеджер: <small><?=Html::encode($label->managerName)?></small> </h6>
        <h6>Препрессник: <small><?=Html::encode($label->prepressName)?></small> </h6>
        <h6>Дата дизайна: <small><?=Html::encode($label->date_of_design)?></small> </h6>
        <h6>Выход этикетки: <?=Html::img($label->outputLabel->image, ['alt' => $label->outputLabel->name,'width'=>'100px'])?></h6>
        <h6>Ориентация: <small class="badge bg-secondary"><?=Html::encode($label->orientationName)?></small> </h6>
        <h6>Тиснение: <small class="badge bg-secondary"><?=Html::encode($label->embossingName)?></small> </h6>
    </div>
</div>
<div class="row p-3">
    <div class="media border col">
        <blockquote class="blockquote">
            <p><?=Html::encode($label->designer_note)?></p>
            <footer class="blockquote-footer">Примечание дизайнера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <p><?=Html::encode($label->manager_note)?></p>
            <footer class="blockquote-footer">Примечание менеджера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <p><?=Html::encode($label->prepress_note)?></p>
            <footer class="blockquote-footer">Примечание Prepress</footer>
        </blockquote>
    </div>
</div>
