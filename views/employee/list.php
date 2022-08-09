<?php
use yii\bootstrap5\Html;

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r($employees)?><!--</pre>-->
<div class="border p-2 rounded">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ФИО</th>
            <th scope="col">Логин</th>
            <th scope="col">Должность</th>
            <th scope="col">Начало р-го дня</th>
            <th scope="col">Конец р-го дня</th>
            <th scope="col">QR-код</th>
        </tr>
        </thead>
        <tbody>
        <?foreach ($employees as $employee):?>
            <tr>
                <td><?=Html::encode($employee['id'])?></td>
                <td><?=Html::encode($employee['F'].' '.$employee['I'].' '.$employee['O'])?></td>
                <td><?=Html::encode($employee['username'])?></td>
                <td>
                    <?foreach ($employee['group'] as $group):?>
                        <h6 class="badge bg-success"><?=Html::encode($group->roleName)?></h6>
                    <?endforeach;?>
                </td>
                <td><?=Html::encode($employee['start_time'])?></td>
                <td><?=Html::encode($employee['end_time'])?></td>
                <td>
                    <?=Html::a('QR-код', ['employee/qr-print','username'=>$employee['username']], ['class'=>'btn btn-primary','target' => '_blank'])?>
                </td>
            </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>
