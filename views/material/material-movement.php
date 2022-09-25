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
<h2><?php echo  Html::encode($this->title) ?></h2>
<?php $form=ActiveForm::begin()?>
<?php echo $form->field($searchModel,'period_start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?php echo $form->field($searchModel,'period_end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?php echo $form->field($searchModel,'search_material_id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),['prompt'=>''])?>
<?php echo $form->field($searchModel,'search_material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),['prompt'=>''])?>

<?php echo html::submitButton('Показать',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>
<div class="table-responsive">
<table class="table text-center table-bordered">
    <thead>
    <tr>
        <th scope="col">Материал</th>
        <th scope="col">Группа</th>
        <th scope="col">Ширина, мм</th>
        <th scope="col">Приход, м</th>
        <th scope="col">Расход, м</th>
        <th scope="col">Сальдо на <?php echo $searchModel->period_end?>, м</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($items))foreach($items as $item):?>
    <?php if(!empty($item->result)):?>
    <?php foreach($item->result as $key=>$value):?>
                <?php if($key!='summary'):?>
                    <tr>
                        <td><?php echo $item->name?></td>
                        <td><?php echo MaterialGroup::findOne($item->material_group_id)->name?></td>
                        <td><?php echo $key?></td>
                        <td><?php echo $value['incoming']?></td>
                        <td><?php echo $value['usage']?></td>
                        <td><?php echo $value['saldo']?></td>
                    </tr>
                <?php else:?>
                    <tr class="table-success">
                        <td colspan="3" >Итого по <?php echo $item->name?></td>
                        <td><?php echo $value['incoming']?></td>
                        <td><?php echo $value['usage']?></td>
                        <td><?php echo $value['saldo']?></td>
                    </tr>
                <?php endif;?>
    <?php endforeach;?>
    <?php endif;?>
    <?php endforeach;?>
    </tbody>
</table>
</div>
<!--<pre>--><?php //
//    $saldo=StockOnHandPaper::findOne(1);
//    $saldo->date='22.08.2022';
//    $saldo->stockOnHand();
//    print_r($saldo)
//    ?><!--</pre>-->
<!--<pre>--><?php //print_r($items)?><!--</pre>-->
