<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CITL',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'Aluno',
//            'url'=>['aluno/index'],
//           // 'options'=>['class'=>'dropdown'],
//            //'template' => '<a href="{url}" class="href_class">{label}</a>',
//         /*   'items' => [
//                ['label' => 'Enviar Email Pagamentos', 'url' => ['site/pagamentos']],
//                ['label' => 'Enviar Email Assunto Formal', 'url' => ['site/init']],
//                ['label' => 'Aluno', 'url'=>['aluno/index']],
//            ]*/
//
//        ],
//        ['label' => 'Categorias', 'items' => [
//            ['label' => 'Consultar Categorias', 'url' => ['categorias/index']],
//            ['label' => 'Criar Categorias', 'url' => ['categorias/create']],
//            ['label' => 'Associar com Sócio', 'url' => ['categorizacao/create']],
//        ]],
//        ['label' => 'Pagamentos', 'url' => ['pagamento/index'],],
//        ['label' => 'Inscrições', 'url' => ['inscricao/index'],],
        //'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Agenda', 'url' => ['/aula/index']],
            ['label' => 'Aluno',
                'url'=>['aluno/index'],
                // 'options'=>['class'=>'dropdown'],
                //'template' => '<a href="{url}" class="href_class">{label}</a>',
                /*   'items' => [
                       ['label' => 'Enviar Email Pagamentos', 'url' => ['site/pagamentos']],
                       ['label' => 'Enviar Email Assunto Formal', 'url' => ['site/init']],
                       ['label' => 'Aluno', 'url'=>['aluno/index']],
                   ]*/

            ],
            ['label' => 'Categorias', 'items' => [
                ['label' => 'Consultar Categorias', 'url' => ['categorias/index']],
                ['label' => 'Criar Categorias', 'url' => ['categorias/create']],
                ['label' => 'Associar com Sócio', 'url' => ['categorizacao/create']],
            ]],
            ['label' => 'Treinador', 'url' => ['treinador/index'],],
            ['label' => 'Inscrições', 'url' => ['inscricao/index'],],
            ['label' => 'Pagamentos', 'url' => ['pagamento/index'],],

            //'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",

        ];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
