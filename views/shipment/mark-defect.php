<?php
use yii\bootstrap5\Html;
use kartik\form\ActiveForm;

/** @var \app\models\Shipment $shipment */
/** @var \app\models\FinishedProductsWarehouse $shipment_roll */

$this->title = Html::encode("Пометить брак");
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка', 'url' => ['shipment/view','id'=>$shipment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo  Html::encode($this->title)?></h3>
<?php $form = ActiveForm::begin(['method'=>'post'])?>
<div class="d-flex col">
        <table class="table border rounded">
            <thead>
            <tr>
                <th scope="col">ID заказа</th>
                <th scope="col">Наименование</th>
                <th scope="col">Этикеток в ролике</th>
                <th scope="col">Кол-во упакованных роликов на отправку</th>
                <th scope="col">Количество возращенных/дефектных роликов</th>
                <th scope="col">Примечание</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($shipment_roll as $id => $roll):?>
                <tr <?php if ($roll->defect_roll_count>0)echo 'class="table-danger"'?>>
                    <td><?php echo Html::encode($roll->order_id)?></td>
                    <td><?php echo Html::encode($roll->label->name)?></td>
                    <td><?php echo Html::encode($roll->label_in_roll)?></td>
                    <td><?php echo Html::encode($roll->sended_roll_count)?></td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]defect_roll_count")->label(false);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]defect_note")->label(false);
                        ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
<?php echo Html::submitButton('Пометить брак', ['name'=>'mark-defect-roll','class'=>'btn btn-primary'])?>
<?php ActiveForm::end()?>
