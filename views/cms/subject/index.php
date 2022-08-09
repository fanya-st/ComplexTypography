<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);


$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Subject', ['subject-create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/subject-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
