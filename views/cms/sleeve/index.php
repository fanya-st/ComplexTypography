<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->title = 'Редактирование втулок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sleeve-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить втулку', ['sleeve-create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/sleeve-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
