<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
//use kartik\bs5dropdown\Dropdown;
use yii\bootstrap5\Dropdown;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/web/favicon.ico']); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

    <?php

    $nav_items=[
        'labels'=>['label' => 'Этикетки', 'items' => [
            ['label' => 'Этикетки', 'url' => ['/label/list']],
            ['label' => 'Создание этикетки', 'url' => ['/label/create']]
        ]],
        'orders'=>['label' => 'Заказы', 'items' => [
            ['label' => 'Заказы', 'url' => ['/order/list']],
            ['label' => 'Создание заказа с готовой этикеткой', 'url' => ['/order/create-blank']],
            ['label' => 'Создание заказа', 'url' => ['/order/create']]
        ]],
        'shipment'=>['label' => 'Отгрузки', 'items' => [
            ['label' => 'Отгрузки', 'url' => ['/shipment/list']],
            ['label' => 'Излишки', 'url' => ['/finished-products-warehouse/surplus-list']],
        ]
        ],
        'material'=>['label' => 'Материалы', 'items' => [
            ['label' => 'Материалы', 'url' => ['/material/list']],
            ['label' => 'Склад бумаги, фольги и ламинации', 'url' => ['/paper-warehouse/list']],
            ['label' => 'Краски, лаки, химия', 'url' => ['/pantone/index']],
            ['label' => 'Склад красок, лаков, химии', 'url' => ['/pantone-warehouse/index']],
            ['label' => 'Загрузка пришедшей бумаги', 'url' => ['/paper-warehouse/upload-paper']]
        ]
        ],
        'accountant'=>['label' => 'Бухгалтерия', 'items' => [
            ['label' => 'Затраты предприятия', 'url' => ['/enterprise-cost/index']],
            ['label' => 'Банк', 'url' => ['/bank-transfer/index']],
            ['label' => 'Оборотная ведомость по материалу', 'url' => ['/material/material-movement']],
            ['label' => 'Наличные складские запасы бумаги', 'url' => ['/material/stock-on-hand-paper']],
            ['label' => 'Финансовый отчет', 'url' => ['/financial-report/index']]
        ]
        ],
        'messenger'=>['label' => 'Мессенджер', 'url' => ['/site/contact']],
//        'about_us'=>['label' => 'О типографии', 'url' => ['/site/about']],
    ];
    if(!Yii::$app->user->isGuest){
        ArrayHelper::setValue($nav_items,'login',
            ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'Сотрудник', 'url' => ['/employee/view','username'=>Yii::$app->user->identity->username]],
                ['label' => 'QR-код', 'url' => ['/employee/qr-print','username'=>Yii::$app->user->identity->username], 'linkOptions' => ['target' => '_blank']],
                ['label' => 'Выйти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]
            ]
        );
        if(ArrayHelper::keyExists('admin', Yii::$app->authManager->getRoles(), false)){
            ArrayHelper::setValue($nav_items,'login.items.cms',['label' => 'Администраторская панель', 'url' => ['/cms/cms-panel']]);
        }


    } else{
        ArrayHelper::setValue($nav_items,'login',['label' => 'Войти', 'url' => ['/site/login']]);
    }?>


<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">loser</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                    <div class="container">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
            </div>
        </div>
    </div>
<!--    <div class="container">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= Alert::widget() ?>
<!--        --><?//= $content ?>
<!--    </div>-->
</main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
