<?php
use yii\bootstrap5\Html;
use kartik\form\ActiveForm;


$this->title = Html::encode("Пометить брак");
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка', 'url' => ['shipment/view','id'=>$shipment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
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
            <?foreach ($shipment_roll as $id => $roll):?>
                <tr <? if ($roll->defect_roll_count>0)echo 'class="table-danger"'?>>
                    <td><?=Html::encode($roll->order_id)?></td>
                    <td><?=Html::encode($roll->label->name)?></td>
                    <td><?=Html::encode($roll->label_in_roll)?></td>
                    <td><?=Html::encode($roll->sended_roll_count)?></td>
                    <td>
                        <?
                        echo $form->field($roll,"[$id]defect_roll_count")->label(false);
                        ?>
                    </td>
                    <td>
                        <?
                        echo $form->field($roll,"[$id]defect_note")->label(false);
                        ?>
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
<?=Html::submitButton('Пометить брак', ['name'=>'mark-defect-roll','class'=>'btn btn-primary'])?>
<? ActiveForm::end()?>
