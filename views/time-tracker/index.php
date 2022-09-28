<?php
use app\models\User;

/** @var \app\models\TimeTrackerSearch $searchModel */

$this->title = 'Электронный табель';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
?>
<?php echo $this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
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
        <th><?php echo User::getFullNameById($row['employee_id'])?></th>
        <td>Не идентифицирован</td>
        <td><?php echo $row['start'].' - '.$row['end']?></td>
        <td><?php echo round($row['hours'],2)?></td>
    </tr>
    <?php else:?>
    <tr>
        <th><?php echo User::getFullNameById($row['employee_id'])?></th>
        <td><?php echo $row['date']?></td>
        <td><?php echo $row['start'].' - '.$row['end']?></td>
        <td><?php echo round($row['hours'],2)?></td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
    </tbody>
    </table>
</div>

