<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;



$this->title = 'Общие параметры калькулятора';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?php echo  Html::encode($this->title) ?></h1>
    <p>
        <?php echo  Html::a('Создать общий параметр для калькулятора', ['calc-common-params-create'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'subscribe',
            'value',
            'date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/calc-common-params-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]) ?>
</div>
