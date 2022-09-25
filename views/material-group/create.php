<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\Models\MaterialGroup $model */

$this->title = 'Добавить тип материала';
$this->params['breadcrumbs'][] = ['label' => 'Типы материалов', 'url' => ['index']];
?>

<h1><?php echo  Html::encode($this->title) ?></h1>

<?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>
