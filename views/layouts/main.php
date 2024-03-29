<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

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
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Моя программа',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $items = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Экзотические Птицы', 'url' => ['/shop/birds']],
        ['label' => 'Товары', 'url' => ['/shop/product']],
    ];
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Авторизация', 'url' => ['/site/login']];
        $items[] = ['label' => 'Регистрация', 'url' => ['/site/registration']];
    } else {
        if (Yii::$app->user->can('admin')) {
            $items[] = [
                'label' => 'Справочники',
                'items' => [
                    ['label' => 'Цвета птиц', 'url' => ['/bird-color']],
                    ['label' => 'Виды птиц', 'url' => ['/bird-type']],
                    ['label' => 'Семейство', 'url' => ['/bird-family']],
                    ['label' => 'Виды продуктов', 'url' => ['/types']],
                ],
                'options' => [
                    'class' => 'drop-list',
                ]
            ];
        }
        $items[] = ['label' => 'Корзина', 'url' => ['/shop/cart']];
        $items[] = '<li class = "nav-item">'
            . HTml::beginForm(['/site/logout'])
            . Html::submitButton(
                'Выход(' . Yii::$app->user->identity->email . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items
    ]);
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
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
