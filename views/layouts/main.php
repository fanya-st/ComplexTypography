<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;

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
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
            'dropdownClass' => Dropdown::class,
            'options' => ['class' => 'navbar-nav mr-auto me-auto'],
        'items' => [
            ['label' => 'Меню', 'items' => [
            ['label' => 'Работа с заказами', 'items' => [
                ['label' => 'Просмотр заказов', 'url' => ['/order/list']],
                ['label' => 'Создание заказа с готовой этикеткой', 'url' => ['/order/create','blank'=>1]],
                ['label' => 'Создание заказа', 'url' => ['/order/create','blank'=>0]]
            ]],
            ['label' => 'Работа с этикетками', 'items' => [
                ['label' => 'Просмотр этикеток', 'url' => ['/label/list']],
                ['label' => 'Создание этикетки', 'url' => ['/label/create']]
            ]],
            ['label' => 'Работа с материалами', 'url' => ['/material/list']],
        ]],
            ['label' => 'О компании', 'url' => ['/site/about']],
            ['label' => 'Обратная связь', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Нажмите чтобы выйти (' . Yii::$app->user->identity->username . ') ',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]
    );
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; ООО "Альпринт" <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
