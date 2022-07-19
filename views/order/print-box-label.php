<?php
use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\web\View;
use app\models\User;
use yii\bootstrap5\Modal;

use yii\bootstrap5\ActiveForm;
Icon::map($this, Icon::FA);


$this->title = Html::encode("Печать ярлыков ID [$order->id] $order->labelName");
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
    'print'
);

?>
<div class="row g-2 row-cols-2">
    <div class="col">
        <?php $form = ActiveForm::begin()?>
        <div id= 'box-label' class="p-1 border rounded">
            <div class="small fw-bold d-flex align-text-bottom"><?=Yii::$app->params['company_full_name'].' т/ф '
                .Yii::$app->params['company_number']?><br><?='Заказчик: '.$order->label->customer->name.
                ' № Заказа: '.$order->id?><br><?=
                'Упаковщик: '.User::getFullNameByUsername($order->packer_login)
                ?>
            </div>
            <table class="table small table-bordered">
                <thead>
                <tr>
                    <th scope="col" style="width:75px;">Наименование</th>
                    <th scope="col" style="width:50px;">кол.рол.</th>
                    <th scope="col" style="width:75px;">кол-во эт. в рол.</th>
                    <th scope="col" style="width:50px;">Общее количество</th>
                </tr>
                </thead>
                <tbody>
                <?$count=count($finished_products)?>
                <?foreach($finished_products as $finished_product):?>
                <?if($finished_product->packed_roll_count != 0):?>
                <tr>
                    <?if( $count > 1):?>
                    <td rowspan="<?=$count?>">
                        <?=$order->label->name?></td>
                        <? $count=null?>
                        <?endif;?>

                    <td><?=$finished_product->packed_roll_count?></td>
                    <td><?=$finished_product->label_in_roll?></td>
                    <td><?=$finished_product->packed_roll_count*$finished_product->label_in_roll?></td>
                    <?$summary+=$finished_product->packed_roll_count*$finished_product->label_in_roll?>
                </tr>
                <?endif;?>
                <?endforeach;?>
                <tr>
                    <td colspan="3">
                        Дата упаковки: <?=Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
                        Срок годности до: <?=Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
                        Условия хранения: при t 22 ± 5 ° и отн.влажности 50 ± 5%
                    </td>
                    <td><?='Всего: '.$summary?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
    <div class="col p-2"><?= Html::button( 'Печать ярлыка для коробки',
            ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("box-label")']) ?>
    </div>
<?php ActiveForm::end() ?>
<div class="col p-2">
    <?foreach($finished_products as $finished_product):?>
        <?=Html::button( 'Ярлык для втулки с '.$finished_product->label_in_roll.'эт',
            ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("'.$finished_product->label_in_roll.'")'])?>
        <?endforeach;?>
</div>
<?foreach($finished_products as $finished_product):?>
    <div id='<?=$finished_product->label_in_roll?>' class="d-none small d-flex align-middle">
        <?=Yii::$app->params['company_full_name']?><br>
        <?='т/ф'.Yii::$app->params['company_number']?><br>
        <?='кол-во: '.$finished_product->label_in_roll?><br>
        <?='Дата: '.Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
        <?='Заказ: №'.$order->id?><br>
    </div>
<?endforeach;?>

</div>





