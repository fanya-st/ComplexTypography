<?php
use app\models\User;
use yii\bootstrap5\Html;

$this->title = User::getFullNameById($employee->id);
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="card">
    <img class="card-img-top img-thumbnail img-fluid" src='pic/john_doe.jpg' alt="Card image">
    <div class="card-body">
        <h4 class="card-title">Фамилия: <?=$employee->F?></h4>
        <h4 class="card-title">Имя: <?=$employee->I?></h4>
        <h4 class="card-title">Отчество: <?=$employee->O?></h4>
        <?php foreach(Yii::$app->authManager->getRolesByUser($employee->id) as $role):?>
            <p class="card-text"><?php echo $role->description?></p>
        <?php endforeach;?>
        <?=Html::a('QR-код', ['employee/qr-print','id'=>$employee->id], ['class'=>'btn btn-primary','target' => '_blank'])?>
    </div>
</div>
