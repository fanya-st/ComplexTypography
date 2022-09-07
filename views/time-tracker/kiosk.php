<?php

use yii\web\View;
use yii\bootstrap5\ActiveForm;
use app\widgets\Alert;
use kartik\icons\Icon;

$this->title = 'Учет рабочего времени';

$this->registerJs(
    "
    function clockTimer()
{
  var date = new Date();
  
  var time = [date.getHours(),date.getMinutes(),date.getSeconds()]; // |[0] = Hours| |[1] = Minutes| |[2] = Seconds|
  var dayOfWeek = ['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота']
  var days = date.getDay();
  
  if(time[0] < 10){time[0] = '0'+ time[0];}
  if(time[1] < 10){time[1] = '0'+ time[1];}
  if(time[2] < 10){time[2] = '0'+ time[2];}
  
  var current_time = [time[0],time[1],time[2]].join(':');
  var clock = document.getElementById('clock');
  var day = document.getElementById('dayOfWeek');
  
  clock.innerHTML = current_time;
  day.innerHTML = dayOfWeek[days];
   
  setTimeout('clockTimer()', 1000);
}
    ",
    View::POS_HEAD,
    'js-timer'
);
?>
<meta http-equiv="refresh" content="60" />
<body onload="clockTimer();">
<!--<pre>--><?//print_r(date_diff(date_create('2022-06-05 08:02:33'),date_create()))?><!--</pre>-->
<div class="d-flex justify-content-center">
    <div class="flex-column">
        <div class="flex-row p-1 justify-content-center"><h1 id="clock" class="display-1"></h1></div>
        <div class="flex-row p-1 text-center"><h1 id="dayOfWeek"></h1></div>
    </div>
</div>
<div class="flex-row p-4 text-center"><?= Alert::widget(['closeButton'=>false,'options'=>['class'=>'p-2 display-4']]) ?></div>
<div class="flex-row p-4 text-center h2">Отсканируйте QR-код</div>
<div class="flex-row p-4 text-center"><?=Icon::show('arrow-down', ['class'=>'fa-3x'], Icon::FA)?></div>
<div class="flex-row p-4 text-center">
    <?$form=ActiveForm::begin()?>
    <?=$form->field($time_tracker,'employee_id',['inputOptions' =>
        ['autofocus' => 'autofocus']])->label(false)?>
    <?ActiveForm::end()?>
</div>

</body>

