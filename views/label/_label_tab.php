<?php

use kartik\helpers\Enum;
use yii\bootstrap5\Html;
use app\models\Form;
use app\models\User;
?>
<div class="row">
    <div class="col">
        <div class="row">
            <?php echo  Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'400px','onerror'=>'label/alt.jpg']),$label->image,['target'=>'_blank'])?>
        </div>
        <?php echo  Html::a('Доп.файл',$label->image_extended,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
        <?php echo  Html::a('Файл дизайна',$label->design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
        <?php echo  Html::a('Файл дизайна Prepress',$label->prepress_design_file,['target'=>'_blank','class'=>'btn btn-success m-2'])?>
    </div>
    <div class="col">
        <h6>№: <small class="badge bg-primary"><?php echo Html::encode($label->id)?></small> Статус этикетки: <small class="badge bg-primary"><?php echo Html::encode($label->labelStatus)?></small> </h6>
        <h6>Заказчик: <small><?php echo Html::encode($label->customer->name)?></small> </h6>
        <h6>Менеджер: <small><?php echo Html::encode(User::getFullNameById($label->customer->user_id))?></small> </h6>
        <h6>Дата создания: <small><?php echo Html::encode($label->date_of_create)?></small> </h6>
        <h6>Дизайнер: <small><?php echo Html::encode(User::getFullNameById($label->designer_id))?></small> </h6>
        <h6>Дата дизайна: <small><?php echo Html::encode($label->date_of_design)?></small> </h6>
        <h6>Препрессник: <small><?php echo Html::encode(User::getFullNameById($label->prepress_id))?></small> </h6>
        <h6>Дата Prepress: <small><?php echo Html::encode($label->date_of_prepress)?></small> </h6>
        <h6>Штанец: <small class="badge bg-secondary"><?php echo Html::encode($label->pants->id)?></small>
            Вал: <small class="badge bg-secondary"><?php echo Html::encode($label->pants->shaft->name)?></small>
            Кол-во форм: <small class="badge bg-secondary"><?php echo Html::encode($label->formCount)?></small></h6>
        <h6></h6>
        <h6>Пантоны: <?php foreach ($label->pantone as $pantone) {
                switch($pantone->name){
                    case 'cyan':
                        echo '<span class="badge rounded-pill bg-info">'.Html::encode($pantone->name).'</span>';
                        break;
                    case 'magenta':
                        echo '<span class="badge rounded-pill bg-danger">'.Html::encode($pantone->name).'</span>';
                        break;
                    case 'yellow':
                        echo '<span class="badge rounded-pill bg-warning">'.Html::encode($pantone->name).'</span>';
                        break;
                    case 'black':
                        echo '<span class="badge rounded-pill bg-black">'.Html::encode($pantone->name).'</span>';
                        break;
                    default:
                        echo '<span class="badge rounded-pill bg-primary">'.Html::encode($pantone->name).'</span>';
                        break;
                }

            }
            ?>
            Фольга: <small class="badge bg-secondary"><?php echo Html::encode($label->foil->name)?></small> </h6>
        <h6>Вид лака: <small class="badge bg-secondary"><?php echo Html::encode($label->varnishStatus->name)?></small></h6>
        <h6>Ламинация: <small class="badge bg-secondary"><?php echo  Enum::boolList()[$label->laminate]?></small> Трафарет: <small class="badge bg-secondary"><?php echo Enum::boolList()[$label->stencil]?></small></h6>
        <h6>Перем.печать: <small class="badge bg-secondary"><?php echo Enum::boolList()[$label->variable]?></small> Печать по клею: <small class="badge bg-secondary"><?php echo  Enum::boolList()[$label->print_on_glue]?></small> </h6>
        <h6>Выход этикетки: <?php echo Html::img($label->outputLabel->image, ['alt' => $label->outputLabel->name,'width'=>'100px'])?></h6>
        <h6>Ориентация: <small class="badge bg-secondary"><?php echo $label->orientationName?></small> Облои снимать: <small class="badge bg-secondary">
                <?php echo  Enum::boolList()[$label->takeoff_flash] ?></small> </h6>
    </div>
    <div class="col">
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <blockquote class="blockquote">
                    <p class="small"><?php echo Html::encode($label->manager_note)?></p>
                    <footer class="blockquote-footer">Примечание менеджера</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <blockquote class="blockquote">
                    <p class="small"><?php echo Html::encode($label->designer_note)?></p>
                    <footer class="blockquote-footer">Примечание дизайнера</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <h6>Параметры Prepress:</h6>
                <h6>Перевывод необходим:</h6>
                <?php if (!empty($label->combination))
                    $defect_forms=Form::find()->where(['not',['form_defect_id'=>null]])
                    ->andWhere(['combination_id'=>$label->combination->combination_id])
                    ->all();
                else
                    $defect_forms=Form::find()->where(['not',['form_defect_id'=>null]])
                    ->andWhere(['label_id'=>$label->id])
                    ->all();
                ?>
                <?php foreach ($defect_forms as $f)
                    echo '<small class="badge rounded-pill bg-danger">'
                        .Html::encode($f->pantoneName.'-'.$f->formDefect->name)
                        .'</small>';
                ?>
                    <h6>Совмещение (ID этикеток): <?php if (isset($label->combinatedLabel)) {
                            foreach ($label->combinatedLabel as $label_id) echo '<span class="badge rounded-pill bg-primary">'.Html::encode($label_id).'</span>';
                        } ?> </h6>
                <blockquote class="blockquote">
                    <p class="small"><?php echo Html::encode($label->prepress_note)?></p>
                    <footer class="blockquote-footer">Примечание Prepress</footer>
                </blockquote>
            </div>
        </div>
        <div class="row border p-2 rounded-lg">
            <div class="col">
                <h6>Параметры Лаборатория:</h6>
                <?php if (!empty($label->combination->combination_id)){
                    $form=Form::find()->where(['combination_id'=>$label->combination])
                            ->one();
                }else{
                    $form=Form::find()->where(['label_id'=>$label->id])->one();
                }
                if (!empty($form->envelope)) {
                    $envelope=$form->envelope->idWithColor;
                }else{
                    $envelope='';
                }
                ?>
                <h6>Конверт: <span class="badge rounded-pill bg-secondary"><?php echo  $envelope?></span></h6>
                <blockquote class="blockquote">
                    <p class="small"><?php echo Html::encode($label->laboratory_note)?></p>
                    <footer class="blockquote-footer">Примечание Лаборатория</footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
