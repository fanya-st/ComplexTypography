<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use app\models\Form;

$this->title = Html::encode("ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title);
    if(isset($label->parent_label)){
        echo Html::a('[Изменение этикетки №'.$label->parent_label.']', ['label/view', 'id' => $label->parent_label]);
    }?></h3>
<?
echo Nav::widget([
    'items' => $nav_items,
    'options' => ['class' => 'nav'],
]);?>
<div class="row">
    <div class="col">
        <div class="row">
            <?= Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'500px','onerror'=>'label/alt.jpg']),$label->image,['target'=>'_blank'])?>
        </div>
            <?= Html::a('Доп.файл',$label->image_extended,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
            <?= Html::a('Файл дизайна',$label->design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
            <?= Html::a('Файл дизайна Prepress',$label->prepress_design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
    </div>
    <div class="col">
        <h6>Статус этикетки: <small class="badge bg-primary"><?=Html::encode($label->labelStatusName)?></small> </h6>
        <h6>Заказчик: <small><?=Html::encode($label->customerName)?></small> </h6>
        <h6>Менеджер: <small><?=Html::encode($label->managerName)?></small> </h6>
        <h6>Дата создания: <small><?=Html::encode($label->date_of_create)?></small> </h6>
        <h6>Дизайнер: <small><?=Html::encode($label->fullName)?></small> </h6>
        <h6>Дата дизайна: <small><?=Html::encode($label->date_of_design)?></small> </h6>
        <h6>Препрессник: <small><?=Html::encode($label->prepressName)?></small> </h6>
        <h6>Дата Prepress: <small><?=Html::encode($label->date_of_prepress)?></small> </h6>
        <h6>Штанец: <small class="badge bg-secondary"><?=Html::encode($label->pantsName)?></small>
            Вал: <small class="badge bg-secondary"><?=Html::encode($label->shaftName)?></small>
            Кол-во форм: <small class="badge bg-secondary"><?=Html::encode($label->formCount)?></small></h6>
        <h6></h6>
        <h6>Пантоны: <? foreach ($label->pantoneName as $pantone) {
            switch($pantone->name){
                case 'cyan':
                    echo '<span class="badge rounded-pill bg-info">'.$pantone->name.'</span>';
                    break;
                case 'magenta':
                    echo '<span class="badge rounded-pill bg-danger">'.$pantone->name.'</span>';
                    break;
                case 'yellow':
                    echo '<span class="badge rounded-pill bg-warning">'.$pantone->name.'</span>';
                    break;
                case 'black':
                    echo '<span class="badge rounded-pill bg-black">'.$pantone->name.'</span>';
                    break;
                default:
                    echo '<span class="badge rounded-pill bg-primary">'.$pantone->name.'</span>';
                    break;
            }

            }
            ?>
            Фольга: <small class="badge bg-secondary"><?=Html::encode($label->foilName)?></small> </h6>
        <h6>Вид лака: <small class="badge bg-secondary"><?=Html::encode($label->varnishStatusName)?></small> Тиснение: <small class="badge bg-secondary"><?=Html::encode($label->embossingName)?></small></h6>
        <h6>Ламинация: <small class="badge bg-secondary"><?=Html::encode($label->laminateName)?></small> Трафарет: <small class="badge bg-secondary"><?=Html::encode($label->stencilName)?></small></h6>
        <h6>Перем.печать: <small class="badge bg-secondary"><?=Html::encode($label->variableName)?></small> Печать по клею: <small class="badge bg-secondary"><?=Html::encode($label->printOnGlueName)?></small> </h6>
        <h6>Выход этикетки: <?=Html::img($label->outputLabel->image, ['alt' => $label->outputLabel->name,'width'=>'100px'])?></h6>
        <h6>Ориентация: <small class="badge bg-secondary"><?=Html::encode($label->orientationName)?></small> </h6>
    </div>
    <div class="col">
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <blockquote class="blockquote">
                    <p class="small"><?=Html::encode($label->manager_note)?></p>
                    <footer class="blockquote-footer">Примечание менеджера</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <blockquote class="blockquote">
                    <p class="small"><?=Html::encode($label->designer_note)?></p>
                    <footer class="blockquote-footer">Примечание дизайнера</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <h6>Параметры Prepress:</h6>
                <h6>Совмещение (ID этикеток): <?foreach ($label->combinatedLabel as $label_id) echo '<span class="badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
                <blockquote class="blockquote">
                    <p class="small"><?=Html::encode($label->prepress_note)?></p>
                    <footer class="blockquote-footer">Примечание Prepress</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <h6>Параметры Лаборатория:</h6>
                <h6>Конверт: <? if (!empty($label->combination->combination_id)):?>
                    <? echo '<span class="badge rounded-pill bg-primary">'.Form::find()->where(['combination_id'=>$label->combination])->one()->envelope->fullLocationName.'</span>'?>
                    <? else: ?>
                    <? echo '<span class="badge rounded-pill bg-primary">'.Form::find()->where(['label_id'=>$label->id])->one()->envelope->fullLocationName.'</span>'?>

                <? endif; ?>
                </h6>
                <blockquote class="blockquote">
                    <p class="small"><?=Html::encode($label->laboratory_note)?></p>
                    <footer class="blockquote-footer">Примечание Лаборатория</footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
