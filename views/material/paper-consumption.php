<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;
use yii\bootstrap5\Modal;
use kartik\icons\Icon;
use Da\QrCode\QrCode;
use yii\widgets\Pjax;

$this->title = Html::encode('Ввод расхода материала для заказа ID ['.$order->id.'] '.$order->label->name);
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];

$this->registerJs(
    "
function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    ",
    View::POS_HEAD,
    'barcode-print'
);
?>
<h3><?= Html::encode($this->title)?></h3>
<?php $form = ActiveForm::begin()?>
    <div class="alert alert-info">
        <strong>Внимание!</strong> Не забудьте распечатать и наклеить новый QR-код на использованный ролик</a>.
    </div>
    <div class="alert alert-info">
        <strong>Внимание!</strong> Материал <?=Html::encode($order->material->name)?>
    </div>
<div class="row">
    <div class="col">
        <?=$form->field($new_used_paper, 'order_id')->hiddenInput(['value' => $order->id])->label(false);?>
        <?=$form->field($new_used_paper,'paper_warehouse_id',['inputOptions' =>
            ['autofocus' => 'autofocus']
        ])->textInput()->label('Штрихкод ролика:')?>
        <?=$form->field($new_used_paper,'length')->label('Длина потраченной бумаги, м:')?>
        <?=Html::submitButton('Ввод',['class'=>'btn btn-success'])?>
    </div>
    <div class="col">
        <div class="border p-2 rounded">
            <table class="table small">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Материал</th>
                    <th scope="col">Длинна</th>
                    <th scope="col">QR-код</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($used_paper as $paper):?>
                    <tr>
                        <td><?=Html::encode($paper->paperWarehouse->id)?></td>
                        <td><?=Html::encode($paper->paperWarehouse->material->name)?></td>
                        <td><?=Html::encode($paper->length)?></td>
                        <td>
                            <?$qrCode = (new QrCode($paper->paperWarehouse->id))
                                ->setSize(300);?>
                            <?
                            Modal::begin([
                                'title'=>'<h4>QR-код</h4>',
                                'toggleButton' => ['label' => 'QR-код', 'class' => 'btn btn-primary'],
                                'id'=>'modal-'.$paper->paperWarehouse->id,
                                'centerVertical'=>true,
                            ]);
                            echo "<div id='modalContent-".$paper->paperWarehouse->id."'>";
                            echo Html::tag('p', Html::encode($paper->paperWarehouse->material->name.' Ширина: '.$paper->paperWarehouse->width.
                                'мм Длина: '.$paper->paperWarehouse->length.' м'),['class'=>'small text-center','style'=>'font-size:10px']);
                            echo Html::tag('div',Html::img($qrCode->writeDataUri(), ['alt' => 'qrcode','width'=>70,'height'=>70]),
                                ['style'=>'text-align:center;']);
                            echo Html::tag('p', Html::encode($paper->paperWarehouse->id),['class'=>'small text-center']);
                            echo "</div>";
                            Modal::end();
                            ?>
                            </td>
                        <td>
                            <?= Html::button( Icon::show('print', ['class'=>'fa-1.5x'], Icon::FA),
                                ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("modalContent-'.$paper->paperWarehouse->id.'")']) ?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>