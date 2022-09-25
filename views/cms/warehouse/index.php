<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;



$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить склад', ['warehouse-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a( 'Редактировать', ['cms/warehouse-update', 'id' => $model->id],
                            ['class' => 'glyphicon glyphicon-edit btn btn-primary']);
                    }
                ],
                 'template' => '{update}',
            ],
        ],
    ])?>
</div>
    <?php ActiveForm::end()?>



