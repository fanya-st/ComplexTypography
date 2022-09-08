<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\helpers\Enum;
use app\models\User;

$this->title = 'Календарь';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin([
        'action' => ['business-trip-employee/calendar'],
        'method' => 'post',
])?>
<p>
<div class="d-lg-flex flex-wrap">
    <div class="p-1"><?=$form->field($searchModel,'calendar_year_select')->dropDownList(Enum::yearList('1995',null, true, true),['class'=>'form-select-lg'])->label(false)?></div>
    <div class="p-1"><?=$form->field($searchModel,'calendar_month_select')->dropDownList(Enum::monthList(),['class'=>'form-select-lg'])->label(false)?></div>
    <div class="p-1"><?=$form->field($searchModel,'user_id')->dropDownList(User::findUsersIdDropdown(),['class'=>'form-select-lg'])->label(false)?></div>
</div>
<div class="d-lg-flex flex-wrap">
    <div class="p-1"><?= Html::submitButton('Сформировать', ['class' => 'btn btn-primary']) ?></div>
</div>
</p>

<?php ActiveForm::end() ?>
                <div class="d-lg-flex flex-wrap">
                    <?if(!empty($searchModel->month_day_count)) for($i=1;$i<=$searchModel->month_day_count;$i++):?>
                        <div class="card m-1" style="min-width: 9rem; min-height: 8rem;" >
                            <div class="card-body">
                                <h4 class="card-title" ><?=$i?></h4>
                                <h6 class="card-subtitle mb-2 text-muted"><?=Enum::dayList(false,2)[date_format(date_create("$searchModel->calendar_year_select-$searchModel->calendar_month_select-$i"),'N')]?></h6>
                                <?foreach ($data as $record):?>
                                <?if(date_format(date_create($record->date_of_begin),'Y-m-d')==date_format(date_create("$searchModel->calendar_year_select-$searchModel->calendar_month_select-$i"),'Y-m-d') ):?>
                                        <span class="badge bg-success text-wrap" style="width: 7rem;"><?=$record->customer->name?></span><br>
                                <?endif;?>
                                <?endforeach;?>
                            </div>
                        </div>
                    <?endfor;?>
                </div>

<!--<pre>--><?//print_r(date_create('1.6.2020'))?><!--</pre>-->

<!--<pre>--><?//print_r()?><!--</pre>-->
