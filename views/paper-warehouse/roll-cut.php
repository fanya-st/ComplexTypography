<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode('Разрезать ролик');
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?php echo  Html::encode($this->title) ?></h2>

<?php if(isset($roll1) && isset($roll2)):?>
    <table class="table small">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Материал</th>
            <th scope="col">Длинна</th>
            <th scope="col">QR-код</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo Html::encode($roll1->id)?></td>
                <td><?php echo Html::encode($roll1->material->name)?></td>
                <td><?php echo Html::encode($roll1->length)?></td>
                <td>
                    <?php echo Html::a('QR-код', ['paper-warehouse/barcode-print','id'=>$roll1->id], ['class'=>'btn btn-primary','target' => '_blank'])?>
                </td>
            </tr>
            <tr>
                <td><?php echo Html::encode($roll2->id)?></td>
                <td><?php echo Html::encode($roll2->material->name)?></td>
                <td><?php echo Html::encode($roll2->length)?></td>
                <td>
                    <?php echo Html::a('QR-код', ['paper-warehouse/barcode-print','id'=>$roll2->id], ['class'=>'btn btn-primary','target' => '_blank'])?>
                </td>
            </tr>
        </tbody>
    </table>
<?php endif;?>

<?php $form = ActiveForm::begin()?>
<?php echo $form->field($paper_warehouse,'paper_warehouse_id',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ролика')?>
<?php echo $form->field($paper_warehouse,'roll_cut_width1')->textInput()?>
<?php echo $form->field($paper_warehouse,'roll_cut_length1')->textInput()?>
<?php echo $form->field($paper_warehouse,'roll_cut_width2')->textInput()?>
<?php echo $form->field($paper_warehouse,'roll_cut_length2')->textInput()?>
<?php echo Html::submitButton('Разрезать',['class'=>'btn btn-success'])?>
<?php ActiveForm::end() ?>
<!--<pre>--><?php //print_r($paper_warehouse)?><!--</pre>-->
