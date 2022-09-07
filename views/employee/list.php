<?php
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\bootstrap5\ActiveForm;
use kartik\icons\Icon;

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="d-lg-inline-flex">
    <?=Html::tag('div',Html::a('Добавить сотрудника', ['employee/create'], ['class'=>'btn btn-primary']),['class'=>'p-1']);?>
</div>

<?ActiveForm::begin(['method'=>'post'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
                'attribute'=>'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        'username',
        'F',
        'I',
        'O',
        [
                'label'=>'Группа',
                'format'=>'raw',
                'value'=>function($model){
                    foreach (Yii::$app->authManager->getRolesByUser($model->id) as $group){
                        $result.=html::tag('h6',Html::encode($group->description),['class'=>'badge bg-success m-1']);
                    }
                    return $result;
                },
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
                'attribute'=>'status_id',
                'format'=>'raw',
                'value'=>function($model){
                        if($model->status_id==0)
                            return html::tag('h6','Работает',['class'=>'badge bg-success']);
                        else
                            return html::tag('h6','Уволен',['class'=>'badge bg-danger']);
                },
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
            'filter'=>[0=>'Работает',1=>'Уволен'],
        ],
        [
                'label'=>'QR-код',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a('QR-код', ['employee/qr-print','id'=>$model->id], ['class'=>'btn btn-primary','target' => '_blank']);
                },
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style'=>'width:10%;'],
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('edit'),
                        ['class' => 'btn btn-outline-success']), ['employee/update', 'id' => $model->id]);
                },
                'delete' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('minus'),
                        ['class' => 'btn btn-outline-danger']), ['employee/fire', 'id' => $model->id]);
                }
            ],
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style'=>'width:10%;'],
        ],
    ],
]); ?>
<?ActiveForm::end()?>
