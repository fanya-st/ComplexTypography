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
    'qrcode-print'
);

$qrCode = (new QrCode($id))
    ->setSize(300);

echo html::beginTag('div',['id'=>'print']);
echo Html::tag('div',Html::img($qrCode->writeDataUri(), ['alt' => 'qrcode','width'=>100,'height'=>100]),
    ['style'=>'text-align:center;']);
echo Html::tag('p', Html::encode($id),['style'=>'font-size:10px;text-align:center;']);
echo html::endTag('div');
