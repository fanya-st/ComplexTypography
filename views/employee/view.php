<?php
use app\models\User;
use yii\bootstrap5\Html;

$this->title = User::getFullNameByUsername($employee->username);
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="card">
    <?if(Yii::$app->mobileDetect->isMobile()):?>
        <img class="card-img-top img-thumbnail img-fluid" src='pic/john_doe.jpg' alt="Card image">
    <?else:?>
        <img class="card-img-top img-thumbnail img-fluid" src='pic/john_doe.jpg' alt="Card image">
    <?endif;?>
    <div class="card-body">
        <h4 class="card-title">Фамилия: <?=$employee->F?></h4>
        <h4 class="card-title">Имя: <?=$employee->I?></h4>
        <h4 class="card-title">Отчество: <?=$employee->O?></h4>
        <?foreach(Yii::$app->authManager->getRolesByUser($employee->id) as $role):?>
            <p class="card-text"><?print_r($role->description)?></p>
        <?endforeach;?>
        <?=Html::a('QR-код', ['employee/qr-print','username'=>$employee->username], ['class'=>'btn btn-primary','target' => '_blank'])?>
    </div>
</div>
