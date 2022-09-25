<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use app\models\Form;

$this->title = Html::encode("ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo  Html::encode($this->title);
    if(isset($label->parent_label)){
        echo Html::a('[Изменение этикетки №'.Html::encode($label->parent_label).']', ['label/view', 'id' => $label->parent_label]);
    }?></h3>
<?php
echo Nav::widget([
    'items' => $nav_items,
    'options' => ['class' => 'nav'],
])?>
<?php echo  $this->render('_label_tab',compact('label')) ?>

