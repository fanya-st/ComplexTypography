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
    <h1><?php echo  Html::encode($this->title) ?></h1>
<?php echo $this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?php echo  Html::a('Добавить расход', ['create'], ['class' => 'btn btn-success']) ?></div>
</div>

<?php ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'date',

            [
                'attribute'=>'user_id',
                'value'=>function($model){
                return User::getFullNameById($model->user_id);
                },
                'filter'=>User::findUsersIdDropdown(),
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
    <?php ActiveForm::end()?>

</div>
