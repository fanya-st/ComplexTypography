<?php

use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\EnterpriseCostService;
use app\models\User;


$this->title = 'Затраты предприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?= Html::a('Добавить расход', ['create'], ['class' => 'btn btn-success']) ?></div>
</div>

<?ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'date',

            [
                'attribute'=>'login',
                'value'=>function($model){
                return User::getFullNameByUsername($model->login);
                },
                'filter'=>User::findUsersDropdown(),
            ],
            [
                    'attribute'=>'service_id',
                    'value'=>'enterpriseCostService.name',
                    'filter'=>ArrayHelper::map(EnterpriseCostService::find()->asArray()->all(),'id','name'),
            ],
            [
                    'attribute'=>'order_id',
            ],

            'cost',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['enterprise-cost/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['enterprise-cost/delete', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>

</div>
