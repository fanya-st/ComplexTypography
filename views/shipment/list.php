<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use app\models\User;

$this->title = 'Работа с отгрузками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>

<div class="border p-3 row g-2 row-cols-lg-2 text-nowrap">
    <div class="col-lg">
            <div class="d-lg-flex flex-wrap">
                <?php $form=ActiveForm::begin([])?>
                <div class="p-1 flex-fill"><?php echo $form->field($new_shipment,'date_of_send')->widget(DatePicker::class, [
                        'options' => ['placeholder' => 'Введите дату отправки ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'autoClose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ])->label(false)?></div>
                <div class="p-1"><?php echo Html::submitButton('Создать',['class'=>'btn btn-success'])?></div>
                <?php ActiveForm::end()?>
            </div>
    </div>
    <div class="col-lg">
        <div class="d-lg-flex flex-wrap">
            <?php echo $this->render('_search', ['model' => $searchModel])?>
        </div>
    </div>
</div>


<?php $form=ActiveForm::begin(['method' => 'post'])?>
<div class="table-responsive">
<?php echo GridView::widget([
    'dataProvider' => $shipments,
    'columns' => [
        [
                'attribute'=>'id',
        ],
        [
            'attribute' => 'manager_id',
            'value' => function($model){
                return User::getFullNameById($model->manager_id);
            },
        ],
        [
            'attribute' => 'shipmentWeight',
            'label' => 'Вес, кг',
        ],

        [
            'attribute' => 'boxBaleCount',
            'label' => 'Кол-во',
        ],
        [
            'attribute' => 'townList',
            'label' => 'Города',
            'value' => function($model){
                if(!empty($model->townList))
                foreach ($model->townList as $town) $list.=$town.', ';
                return $list;
            },
        ],
        [
            'attribute' => 'date_of_create',
            'value' => 'date_of_create',
        ],
        [
            'attribute' => 'date_of_send',
            'value' => 'date_of_send',
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'
        ],
    ],
])?>
</div>
<?php ActiveForm::end()?>
