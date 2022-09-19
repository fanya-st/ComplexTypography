<?php
use app\models\User;


$this->title = 'Электронный табель';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
?>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
<!--    <div class="p-2">--><?//= Html::a('Добавить поступление', ['create'], ['class' => 'btn btn-success']) ?><!--</div>-->
</div>
<div class="table-responsive">
    <table class="table table-bordered caption-top">
        <caption>Табель учета времени</caption>
    <thead>
    <tr>
        <th scope="col">Сотрудник</th>
        <th scope="col">Дата</th>
        <th scope="col">Время отметок</th>
        <th scope="col">Часы</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($timesheet))foreach($timesheet as $row):?>
    <?php if(empty($row['hours'])):?>
    <tr class="table-danger">
        <th><?=User::getFullNameById($row['employee_id'])?></th>
        <td>Не идентифицирован</td>
        <td><?=$row['start'].' - '.$row['end']?></td>
        <td><?=round($row['hours'],2)?></td>
    </tr>
    <?else:?>
    <tr>
        <th><?=User::getFullNameById($row['employee_id'])?></th>
        <td><?=$row['date']?></td>
        <td><?=$row['start'].' - '.$row['end']?></td>
        <td><?=round($row['hours'],2)?></td>
    </tr>
    <?endif;?>
    <?endforeach;?>
    </tbody>
    </table>
<!--    <pre>--><?php //print_r(date_format(date_create('2022-09-07'),"Y-m-d H:i:s"))?><!--</pre>-->
    <pre><?php print_r($timesheet)?></pre>
</div>

