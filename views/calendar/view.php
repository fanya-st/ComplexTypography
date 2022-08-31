<?php
use daxslab\calendly\Calendly;
?>
<?= Calendly::widget([
//    'calendlyId' => Yii::$app->params['calendlyId'],
    'calendlyId' => 1,
    'mode' => Calendly::MODE_INLINE,
]) ?>
