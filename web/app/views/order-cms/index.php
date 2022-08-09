<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderCmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_of_create',
            'status_id',
            'label_id',
            'date_of_sale',
            //'date_of_print_begin',
            //'date_of_print_end',
            //'date_of_packing_begin',
            //'date_of_packing_end',
            //'date_of_rewind_begin',
            //'date_of_rewind_end',
            //'mashine_id',
            //'plan_circulation',
            //'actual_circulation',
            //'trial_circulation',
            //'sending',
            //'material_id',
            //'printer_login',
            //'order_price',
            //'order_price_with_tax',
            //'delivery_price',
            //'pants_price',
            //'label_price',
            //'label_price_with_tax',
            //'rewinder_login',
            //'packer_login',
            //'rewinder_note:ntext',
            //'printer_note:ntext',
            //'tech_note:ntext',
            //'sleeve_id',
            //'winding_id',
            //'diameter_roll',
            //'label_on_roll',
            //'cut_edge',
            //'stretch',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
