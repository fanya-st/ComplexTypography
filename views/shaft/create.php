<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shaft */

$this->title = 'Create Shaft';
$this->params['breadcrumbs'][] = ['label' => 'Shafts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shaft-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
