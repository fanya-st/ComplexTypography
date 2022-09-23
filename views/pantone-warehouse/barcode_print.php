<?php
use yii\web\View;
use yii\bootstrap5\Html;
use kartik\icons\Icon;
use Da\QrCode\QrCode;
Icon::map($this, Icon::FA);


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
$qrCode = (new \chillerlan\QRCode\QRCode())->render($pantone_warehouse->id);

                echo html::beginTag('div',['id'=>'print']);
                echo Html::tag('p', Html::encode($pantone_warehouse->pantone->name.' Вес: '.$pantone_warehouse->weight.' кг'),
                    ['style'=>'font-size:10px;text-align:center;']);
                echo Html::tag('div',Html::img($qrCode, ['alt' => 'qrcode','width'=>70,'height'=>70]),
                    ['style'=>'text-align:center;']);
                echo Html::tag('p', Html::encode($pantone_warehouse->id),['style'=>'font-size:10px;text-align:center;']);
                echo html::endTag('div');
