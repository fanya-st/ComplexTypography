<?php

use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\LabelStatus;
use app\models\Customer;
use yii\grid\GridView;


$this->title = 'Этикетки';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php $form=ActiveForm::begin(['method'=>'post'])?>

<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            'name',
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
    ]) ?>
</div>
    <?php ActiveForm::end()?>



