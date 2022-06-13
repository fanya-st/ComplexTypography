<?php

/** @var yii\web\View $this */

$this->title = 'Комплекс Типография';
?>
<div class="site-index">

    <!--<div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Работа с заказами</h2>
                <p>Просмотр, создание, удаление заказов</p>
                <p><a class="btn btn-outline-secondary" href="?r=order%2Flist">Работа с заказами &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=order%2Fcreate&blank=1">Создание заказа с готовой этикеткой &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=order%2Fcreate&blank=0">Создание заказа &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Работа с материалами</h2>
                <p>Просмотр, создание, удаление материалов</p>
                <p><a class="btn btn-outline-secondary" href="">Работа с материалами &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Работа с этикетками</h2>
                <p>Работа с этикетками</p>
                <p><a class="btn btn-outline-secondary" href="?r=label/list">Работа с этикетками &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=label%2Fcreate">Создание этикетки &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
