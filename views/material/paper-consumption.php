<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;
use yii\bootstrap5\Modal;
use kartik\icons\Icon;;
Icon::map($this, Icon::FA);

$this->title = Html::encode("Ввод расхода материала для заказа ID [$order->id] $order->labelName");
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->labelName, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;

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
        <strong>Внимание!</strong> Не забудьте распечатать и наклеить новый штрих-код на использованный ролик</a>.
    </div>
    <div class="alert alert-info">
        <strong>Внимание!</strong> Материал <?=Html::encode($order->material->name)?></a>.
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
                    <th scope="col">Штрикод</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($used_paper as $paper):?>
                    <tr>
                        <td><?=Html::encode($paper->paper_warehouse_id)?></td>
                        <td><?=Html::encode($paper->paperWarehouse->material->name)?></td>
                        <td><?=Html::encode($paper->length)?></td>
                        <td>

                            <?
                            Modal::begin([
                                'title'=>'<h4>Штрихкод</h4>',
                                'toggleButton' => ['label' => 'Штрихкод', 'class' => 'btn btn-primary'],
                                'id'=>'modal-'.$paper->paper_warehouse_id,
                                'centerVertical'=>true,
                            ]);
                            echo "<div id='modalContent-".$paper->paper_warehouse_id."'>";
                            echo Html::tag('p', Html::encode($paper->paperWarehouse->material->name.' Ширина: '.$paper->paperWarehouse->width.
                                'см Длина: '.$paper->paperWarehouse->length.' м'),['class'=>'small text-center','style'=>'font-size:10px']);
                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            echo Html::tag('div',Html::img('data:image/png;base64,' . base64_encode($generator->
                                getBarcode(str_pad($paper->paper_warehouse_id, 12, '0', STR_PAD_LEFT),
                                    $generator::TYPE_EAN_13,2, 70)) . '', ['alt' => 'barcode','class'=>'text-center']),
                                ['class'=>'text-center']);
                            echo Html::tag('p', Html::encode($paper->paper_warehouse_id),['class'=>'small text-center']);
                            echo "</div>";
                            Modal::end();
                            ?>
                            </td>
                        <td>
                            <?= Html::button( Icon::show('print', ['class'=>'fa-1.5x'], Icon::FA),['class' => 'btn btn-outline-primary','onclick'=>'printDiv("modalContent-'.$paper->paper_warehouse_id.'")']) ?>

                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>