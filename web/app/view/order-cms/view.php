<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_of_create',
            'status_id',
            'label_id',
            'date_of_sale',
            'date_of_print_begin',
            'date_of_print_end',
            'date_of_packing_begin',
            'date_of_packing_end',
            'date_of_rewind_begin',
            'date_of_rewind_end',
            'mashine_id',
            'plan_circulation',
            'actual_circulation',
            'trial_circulation',
            'sending',
            'material_id',
            'printer_login',
            'order_price',
            'order_price_with_tax',
            'delivery_price',
            'pants_price',
            'label_price',
            'label_price_with_tax',
            'rewinder_login',
            'packer_login',
            'rewinder_note:ntext',
            'printer_note:ntext',
            'tech_note:ntext',
            'sleeve_id',
            'winding_id',
            'diameter_roll',
            'label_on_roll',
            'cut_edge',
            'stretch',
        ],
    ]) ?>

</div>
