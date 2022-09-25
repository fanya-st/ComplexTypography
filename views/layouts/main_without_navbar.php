<?php


use app\assets\AppAsset;
use yii\bootstrap5\Html;

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
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/web/favicon.ico']); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <?php echo  $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
