<?php
use yii\bootstrap4\Html;

$this->title = Html::encode("Редактирование ID [$label->id] $label->name");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<pre>--><?php //print_r($label->designer_login)?><!--</pre>-->
<!--<pre>--><?php //print_r(Yii::$app->user->identity->username)?><!--</pre>-->
<h3><?= Html::encode($this->title)?></h3>
<div class="d-flex flex-row">
    <div class="p-2 flex-fill"><?= Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'500px']),$label->image,['target'=>'_blank'])?></div>
    <div class="p-2 flex-fill">
        <h6>Статус этикетки: <small><?=Html::encode($label->labelStatusName)?></small> </h6>
        <h6>Заказчик: <small><?=Html::encode($label->customerName)?></small> </h6>
        <h6>Дата создания: <small><?=Html::encode($label->date_of_create)?></small> </h6>
        <h6>Дата Prepress: <small><?=Html::encode($label->date_of_prepress)?></small> </h6>
        <h6>Штанец: <small><?=Html::encode($label->pantsName)?></small> Вал: <small><?=Html::encode($label->shaftName)?></small></h6>
        <h6>Количество форм: <small><?=Html::encode($label->formCount)?></small></h6>
        <h6>Пантоны: <? foreach ($label->pantone as $pantone) echo '<span class="badge badge-primary">'.$pantone->name.'</span>'?></h6>
        <h6>Фольга: <small><?=Html::encode($label->foilName)?></small> </h6>
        <h6>Вид лака: <small><?=Html::encode($label->varnishStatusName)?></small> </h6>
        <h6>Ламинация: <small><?=Html::encode($label->laminateName)?></small> Трафарет: <small class="badge badge-secondary"><?=Html::encode($label->stencilName)?></small></h6>
        <h6>Перем.печать: <small class="badge badge-secondary"><?=Html::encode($label->variableName)?></small> Печать по клею: <small class="badge badge-secondary"><?=Html::encode($label->printOnGlueName)?></small> </h6>
        <h6 class="badge badge-primary"><?=Html::encode($label->fullCMYK)?></h6>
    </div>
    <div class="p-2 flex-fill">
        <h6>Дизайнер: <small><?=Html::encode($label->fullName)?></small> </h6>
        <h6>Дата дизайна: <small><?=Html::encode($label->date_of_design)?></small> </h6>
        <h6>Выход этикетки: <?=Html::img($label->outputLabel->image, ['alt' => $label->outputLabel->name,'width'=>'100px'])?></h6>
    </div>
</div>
<div class="row">
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->designer_note)?></small>
            <footer class="blockquote-footer">Примечание дизайнера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->manager_note)?></small>
            <footer class="blockquote-footer">Примечание менеджера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->prepress_note)?></small>
            <footer class="blockquote-footer">Примечание Prepress</footer>
        </blockquote>
    </div>
</div>