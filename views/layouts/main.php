<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;
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
            ['label' => 'Загрузка пришедшей бумаги', 'url' => ['/paper-warehouse/upload-paper']]
        ]
        ],
        'messenger'=>['label' => 'Мессенджер', 'url' => ['/site/contact']],
        'about_us'=>['label' => 'О типографии', 'url' => ['/site/about']],
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
        if(ArrayHelper::keyExists('admin', Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->getId()), false)){
            ArrayHelper::setValue($nav_items,'login.items.cms',['label' => 'Администраторская панель', 'url' => ['/cms/cms-panel']]);
        }


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
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
<!--        <pre>--><?//= print_r($nav_items) ?><!--</pre>-->
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?=Yii::$app->params['company_full_name']?><?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
