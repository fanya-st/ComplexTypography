<?php
use yii\bootstrap5\Html;


$this->title = 'Электронный табель';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
?>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
<!--    <div class="p-2">--><?//= Html::a('Добавить поступление', ['create'], ['class' => 'btn btn-success']) ?><!--</div>-->
</div>
<div class="table-responsive">
<!--    <pre>--><?php //print_r($dataProvider->getModels())?><!--</pre>-->
    <pre><?php print_r($timesheet)?></pre>
</div>

