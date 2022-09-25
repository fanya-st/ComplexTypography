<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;


$this->title = $order->label->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['cms/order-list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?php echo  Html::a('Редактировать', ['cms/order-update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::a('Удалить', ['cms/order-delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $order,
        'attributes' => [
            'id',
            [
                    'label'=>'Наименование',
                    'value'=>$order->label->name,
            ],
            'date_of_create',
            [
                'attribute'=>'status_id',
                'value'=>$order->orderStatus->name,
            ],
            'label_id',
            'date_of_sale',
            'date_of_print_begin',
            'date_of_print_end',
            'date_of_packing_begin',
            'date_of_packing_end',
            'date_of_rewind_begin',
            'date_of_rewind_end',
            [
                'attribute'=>'mashine_id',
                'value'=>$order->mashine->name,
            ],
            'plan_circulation',
            'actual_circulation',
            [
                'attribute'=>'trial_circulation',
                'value'=>function($order){
                    if($order->trial_circulation==1)
                        return 'Да';
                    else
                        return 'Нет';

                },
            ],
            'sending',
            [
                'attribute'=>'material_id',
                'value'=>$order->material->name,
            ],
            [
                'attribute'=>'printer_id',
                'value'=>User::getFullNameById($order->printer_id),
            ],
            'order_price',
            'order_price_with_tax',
            'delivery_price',
            'pants_price',
            'label_price',
            'label_price_with_tax',
            [
                'attribute'=>'rewinder_id',
                'value'=>User::getFullNameById($order->rewinder_id),
            ],
            [
                'attribute'=>'packer_id',
                'value'=>User::getFullNameById($order->packer_id),
            ],
            'rewinder_note:ntext',
            'printer_note:ntext',
            'tech_note:ntext',
            [
                'attribute'=>'sleeve_id',
                'value'=>$order->sleeve->name,
            ],
            [
                'attribute'=>'winding_id',
                'value'=>function($order){
                    return $order->winding->image;

                },
                'format' => ['image',['width'=>'100','title'=>$order->winding->name]],
            ],
            'label_on_roll',
            [
                'attribute'=>'cut_edge',
                'value'=>function($order){
                    if($order->cut_edge==1)
                        return 'Да';
                        else
                            return 'Нет';

                },
            ],
            [
                'attribute'=>'stretch',
                'value'=>function($order){
                    if($order->stretch==1)
                        return 'Да';
                        else
                            return 'Нет';

                },
            ],
        ],
    ]) ?>

</div>

