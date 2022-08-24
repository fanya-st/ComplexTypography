<?php

use app\models\StockOnHandPaper;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use app\models\Material;
use app\models\MaterialGroup;

$this->title = Html::encode('Оборотная ведомость по материалу');
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<?$form=ActiveForm::begin()?>
<?=$form->field($searchModel,'period_start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'period_end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'search_material_id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),['prompt'=>''])?>
<?=$form->field($searchModel,'search_material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),['prompt'=>''])?>

<?=html::submitButton('Показать',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<div class="table-responsive">
<table class="table text-center table-bordered">
    <thead>
    <tr>
        <th scope="col">Материал</th>
        <th scope="col">Группа</th>
        <th scope="col">Ширина, мм</th>
        <th scope="col">Приход, м</th>
        <th scope="col">Расход, м</th>
        <th scope="col">Сальдо на <?=$searchModel->period_end?>, м</th>
    </tr>
    </thead>
    <tbody>
    <?if(!empty($items))foreach($items as $item):?>
    <?if(!empty($item->result)):?>
    <?foreach($item->result as $key=>$value):?>
                <?if($key!='summary'):?>
                    <tr>
                        <td><?=$item->name?></td>
                        <td><?=MaterialGroup::findOne($item->material_group_id)->name?></td>
                        <td><?=$key?></td>
                        <td><?=$value['incoming']?></td>
                        <td><?=$value['usage']?></td>
                        <td><?=$value['saldo']?></td>
                    </tr>
                <?else:?>
                    <tr class="table-success">
                        <td colspan="3" >Итого по <?=$item->name?></td>
                        <td><?=$value['incoming']?></td>
                        <td><?=$value['usage']?></td>
                        <td><?=$value['saldo']?></td>
                    </tr>
                <?endif;?>
    <?endforeach;?>
    <?endif;?>
    <?endforeach;?>
    </tbody>
</table>
</div>
<!--<pre>--><?//
//    $saldo=StockOnHandPaper::findOne(1);
//    $saldo->date='22.08.2022';
//    $saldo->stockOnHand();
//    print_r($saldo)
//    ?><!--</pre>-->
<pre><?print_r($items)?></pre>
