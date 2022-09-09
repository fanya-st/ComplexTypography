<?php
use yii\web\View;
use yii\bootstrap5\Html;
use Da\QrCode\QrCode;


$this->registerJs(
    "
function printDiv(){
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    window.onload = printDiv;
    ",
    View::POS_HEAD,
    'barcode-print'
);
$qrCode = (new QrCode($paper_warehouse->id))
    ->setSize(300);

                echo html::beginTag('div',['id'=>'print']);
                echo Html::tag('p', Html::encode($paper_warehouse->material->name.' Ширина: '.$paper_warehouse->width.
                    'мм Длина: '.$paper_warehouse->length.' м'),['style'=>'font-size:10px;text-align:center;']);
                echo Html::tag('div',Html::img($qrCode->writeDataUri(), ['alt' => 'qrcode','width'=>70,'height'=>70]),
                    ['style'=>'text-align:center;']);
                echo Html::tag('p', Html::encode($paper_warehouse->id),['style'=>'font-size:10px;text-align:center;']);
                echo html::endTag('div');
