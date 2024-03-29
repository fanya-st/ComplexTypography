<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
//use kartik\bs5dropdown\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Dropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo  Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?php echo  Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?php echo  Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => 'favicon.ico']); ?>
</head>
<body class="d-flex flex-column h-100">
<?php //phpinfo()?>
<?php $this->beginBody() ?>

<header>
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
    ];
    if(!Yii::$app->user->isGuest){
        ArrayHelper::setValue($nav_items,'login',
            ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'Сотрудник', 'url' => ['/employee/view','id'=>Yii::$app->user->identity->getId()]],
                ['label' => 'QR-код', 'url' => ['/employee/qr-print','id'=>Yii::$app->user->identity->getId()], 'linkOptions' => ['target' => '_blank']],
                ['label' => 'Выйти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ]
                ]
        );


    } else{
        ArrayHelper::setValue($nav_items,'login',['label' => 'Войти', 'url' => ['/site/login']]);
    }
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['class'=>'p-1'],
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
            'dropdownClass' => Dropdown::class,
            'options' => ['class' => 'navbar-nav mr-auto me-auto'],
        'items' => $nav_items,
    ]
    );
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
                <?php echo  Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?php echo  Alert::widget() ?>
                <?php echo  $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?php echo Yii::$app->params['company_full_name']?> <?php echo date('Y') ?></p>
<!--        <p class="float-right">--><?php //= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
