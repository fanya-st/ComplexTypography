<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

$this->title = Html::encode("Просмотр ID [$customer->id] $customer->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказчиками', 'url' => ['customer/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
<?php
echo DetailView::widget([
    'model' => $customer,
    'attributes' => [
        'id',
        'name',
        'managerFullName',
        'customerStatus.name',
        'date_of_agreement',
        'customerAddress',
        'contact',
        'number',
        'email',
        'comment',
        'date_of_create',
    ],
])
?>