<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\auctions\models\Auctions;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Добро пожаловать </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/shop.style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/css/line-icons.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/css/jquery.nouislider.css">

    <?= Html::csrfMetaTags() ?>

</head>

<body class="header-fixed">


<div class="wrapper">
<!--=== Header v5 ===-->
<div class="header-v5 header-static">

    <div class="topbar-v3">
        <div class="search-open">
            <div class="container">
                <input type="text" class="form-control" placeholder="Search">
                <div class="search-close"><i class="icon-close"></i></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Topbar Navigation -->

                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!--/container-->
    </div>
    <!-- Navbar -->
    <div class="navbar navbar-default mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand"  href="/">
                    <img id="logo-header" src="/img/logo.png" alt="Logo" style="margin-top: -10px;">
                </a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">



                <?php  echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Главная', 'url' => ['/'],'active'=>Yii::$app->controller->id == 'site'],
                        ['label' => 'Аукционы', 'url' => ['/auctions/']],
                        ['label' => 'Магазин', 'url' => \yii\helpers\Url::to('https://shop.imperial-k.ru')],
                        ['label' => 'Контакты', 'url' => \yii\helpers\Url::to('/contact')],
                        ['label' => 'Филиалы', 'url' => \yii\helpers\Url::to('/filials')],
                        (Yii::$app->user->identity->role == 20) ?
                        ['label' => 'Админпанель', 'url' => \yii\helpers\Url::to('/admin')] : '',

                    ],
                ]);
                ?>
            </div><!--/navbar-collapse-->
        </div>
    </div>
    <!-- End Navbar -->
</div>
<!--=== End Header v5 ===-->



<!--=== Content Part ===-->
<div class="content container">
    <div class="row">

        <div class="col-md-12">
            <?= $content ?>

        </div>
    </div><!--/end row-->
</div><!--/end container-->
<!--=== End Content Part ===-->


<!--=== Footer v4 ===-->
    <?= \app\components\FooterWidget::widget(['type'=>2])?>
<!--=== End Footer v4 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="/js/back-to-top.js"></script>


<!-- JS Page Level -->

<script>
    jQuery(document).ready(function() {
    });
</script>
<!--[if lt IE 9]>
<script src="assets/plugins/respond.js"></script>
<script src="assets/plugins/html5shiv.js"></script>
<script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<script src="assets/plugins/sky-forms/version-2.0.1/js/jquery.placeholder.min.js"></script>
<![endif]-->
</body>
</html> 