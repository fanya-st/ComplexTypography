<?php

use yii\helpers\Html;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\LabelStatus;
use app\models\Customer;
use yii\grid\GridView;


$this->title = 'Label';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="label-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?$form=ActiveForm::begin(['method'=>'post'])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
//            'parent_label',
            'name',
//            'designer_note:ntext',
//            'manager_note:ntext',
            //'prepress_note:ntext',
            //'date_of_create',
            'date_of_design',
            'date_of_prepress',

            [
                'attribute' => 'customer_id',
                'value' => 'customer.name',
                'filter' => ArrayHelper::map(Customer::find()->asArray()->all(),'id','name'),
            ],
            [
                'attribute' => 'status_id',
                'label' => 'Статус',
                'value' => 'labelStatus',
                'filter' => LabelStatus::$label_status,
            ],
            //'pants_id',
            //'foil_id',
            [
                'attribute' => 'designer_id',
                'value' => function($model){
                    return User::getFullNameById($model->designer_id);
                },
                'filter' => User::findUsersByGroup('designer'),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/label-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
