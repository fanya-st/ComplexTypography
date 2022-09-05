<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\BankTransfer;
use yii\grid\GridView;
use app\models\User;
use kartik\icons\Icon;

$this->title = 'Банк';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?= Html::a('Добавить поступление', ['create'], ['class' => 'btn btn-success']) ?></div>
</div>
    <?ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'customer_id',
                'value'=>'customer.name',
                'contentOptions'=>['class' => 'text-left'],
                'headerOptions' => ['class' => 'text-left'],
            ],
            [
                'label' => 'Менеджер',
                'value'=>function($model){
                    return User::getFullNameByUsername($model->customer->manager_login);
                },
                'contentOptions'=>['class' => 'text-left'],
                'headerOptions' => ['class' => 'text-left'],
            ],
            [
                'attribute' => 'date',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'sum',
                'footer' => BankTransfer::getTotal($dataProvider->models, 'sum'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'footerOptions' => ['class' => 'text-center fw-bolder'],
            ],

//            'date_of_create',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['bank-transfer/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['bank-transfer/delete', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
        <?ActiveForm::end()?>

</div>
