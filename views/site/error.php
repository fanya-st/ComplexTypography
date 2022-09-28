<?php

use yii\bootstrap5\Html;

/** @var string $name */
/** @var string $message */

$this->title = $name;
?>
<div class="site-error">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php echo  nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Вышеупомянутая ошибка произошла, когда веб-сервер обрабатывал ваш запрос.
    </p>
    <p>
        Пожалуйста свяжитесь с администратором для решения проблемы.
    </p>

</div>
