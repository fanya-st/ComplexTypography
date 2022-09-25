<?php

use yii\bootstrap5\Html;
use kartik\detail\DetailView;



$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Командировки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="business-trip-employee-view">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_of_begin',
            'date_of_end',
            'gasoline_cost',
            'cost',
            'user_id',
            'transport_id',
            'customer_id',
            'status_id',
            'comment',
        ],
    ]) ?>

</div>
