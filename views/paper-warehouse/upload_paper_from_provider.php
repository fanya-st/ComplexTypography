<?php


use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode("Загрузка пришедшей бумаги");
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?php echo  Html::encode($this->title) ?></h2>
<!--<pre>--><?php //print_r(Yii::$app->request->post())?><!--</pre>-->
<?php $form = ActiveForm::begin()?>
<div class="alert alert-info">
    <strong>Внимание!</strong> Загрузка файлов производится в формате CSV!
</div>
<div class="alert alert-info">
    <strong>Внимание!</strong> Со столбцами: "PALLET_ID", "ROLL_WIDTH", "ROLL_LENGTH", "CODE_1C" , "ROLL_NUMBER".
    !ПЕРВЫЙ СТОЛБЕЦ С ЗАГОЛОВКАМИ СТОЛБЦОВ НЕ УДАЛЯЕМ ЛИБО ЖЕ ПЕРВУЮ СТРОКУ ДЕЛАЕМ ПУСТОЙ (см.пример)!
    !ПОСЛЕДНЮЮ СТРОКУ ДЕЛАЕМ ПУСТОЙ (см.пример)!
</div>
<div>
    <img src='pic/example.jpg' class="img-fluid" alt="Responsive image">
</div>

<?php echo $form->field($upload_paper_form,'csv')->fileInput()?>
<?php echo Html::submitButton('Загрузить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end() ?>
