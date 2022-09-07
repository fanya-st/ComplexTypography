<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\CustomerStatus;
use yii\bootstrap5\ActiveForm;
use app\models\User;

$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-form-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?$form=ActiveForm::begin(['method'=>'post'])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'date_of_agreement',
            [
                'attribute'=>'status_id',
                'value'=>'customerStatus',
                'filter'=>CustomerStatus::$customer_status,
            ],
            'name',
            [
                'label'=>'Менеджер',
                'attribute'=>'user_id',
                'value'=>function($model) {
                    return User::getFullNameById($model->user_id);
                },
                'filter'=>User::findUsersByGroup('manager'),
            ],
            //'subject_id',
            //'region_id',
            //'town_id',
            //'street_id',
            //'house',
            //'email:email',
            //'number',
            //'comment:ntext',
            //'time_to_delivery_from',
            //'time_to_delivery_to',
            //'contact',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/customer-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>

</div>
