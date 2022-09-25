<?php
use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\web\View;
use app\models\User;
use yii\bootstrap5\Modal;

use yii\bootstrap5\ActiveForm;


$this->title = Html::encode('Печать ярлыков ID ['.$order->id.'] '.$order->label->name);
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
    'print'
);

?>
<div class="row g-2 row-cols-2">
    <div class="col">
        <?php $form = ActiveForm::begin()?>
        <div id= 'box-label' class="p-1 border rounded">
            <div class="small fw-bold d-flex align-text-bottom"><?php echo Yii::$app->params['company_full_name'].' т/ф '
                .Yii::$app->params['company_number']?><br><?php echo 'Заказчик: '.$order->label->customer->name.
                ' № Заказа: '.$order->id?><br><?php echo 
                'Упаковщик: '.User::getFullNameById($order->packer_id)
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
                <?php $count=count($finished_products)?>
                <?php foreach($finished_products as $finished_product):?>
                <?php if($finished_product->packed_roll_count != 0):?>
                <tr>
                    <?php if( $count > 1):?>
                    <td rowspan="<?php echo $count?>">
                        <?php echo $order->label->name?></td>
                        <?php $count=null?>
                        <?php endif;?>

                    <td><?php echo $finished_product->packed_roll_count?></td>
                    <td><?php echo $finished_product->label_in_roll?></td>
                    <td><?php echo $finished_product->packed_roll_count*$finished_product->label_in_roll?></td>
                    <?php $summary+=$finished_product->packed_roll_count*$finished_product->label_in_roll?>
                </tr>
                <?php endif;?>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">
                        Дата упаковки: <?php echo Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
                        Срок годности до: <?php echo Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
                        Условия хранения: при t 22 ± 5 ° и отн.влажности 50 ± 5%
                    </td>
                    <td><?php echo 'Всего: '.$summary?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
        </div>
    <div class="col p-2"><?php echo  Html::button( 'Печать ярлыка для коробки',
            ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("box-label")']) ?>
    </div>
<?php ActiveForm::end() ?>
<div class="col p-2">
    <?php foreach($finished_products as $finished_product):?>
        <?php echo Html::button( 'Ярлык для втулки с '.$finished_product->label_in_roll.'эт',
            ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("'.$finished_product->label_in_roll.'")'])?>
        <?php endforeach;?>
</div>
<?php foreach($finished_products as $finished_product):?>
    <div id='<?php echo $finished_product->label_in_roll?>' class="d-none small d-flex align-middle">
        <?php echo Yii::$app->params['company_full_name']?><br>
        <?php echo 'т/ф'.Yii::$app->params['company_number']?><br>
        <?php echo 'кол-во: '.$finished_product->label_in_roll?><br>
        <?php echo 'Дата: '.Yii::$app->formatter->asDate('now', 'dd.MM.yyyy')?><br>
        <?php echo 'Заказ: №'.$order->id?><br>
    </div>
<?php endforeach;?>

</div>





