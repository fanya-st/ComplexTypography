<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\AuthItem;
use yii\helpers\ArrayHelper;

/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \app\models\AuthItemSearch $searchModel */


$this->title = 'Привязка сотрудников к группам';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['employee/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>

<p>
    <?php echo  Html::a('Добавить', ['auth-assign-create'], ['class' => 'btn btn-success']) ?>
</p>

    <?php ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute'=>'user_id',
                    'filter'=>User::findUsersIdDropdown(),
                    'value'=>function($model){return User::getFullNameById($model->user_id); },
            ],
            [
                    'attribute'=>'item_name',
                    'filter'=>ArrayHelper::map(AuthItem::find()->where(['type'=>1])->asArray()->all(),'name','description'),
                    'value'=>function($model){
                        return AuthItem::findOne($model->item_name)->description;
                    },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['cms/auth-assign-update', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['cms/auth-assign-delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                    },
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye'),
                            ['class' => 'btn btn-outline-success']), ['cms/auth-assign-view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ])?>
</div>
    <?php ActiveForm::end()?>



