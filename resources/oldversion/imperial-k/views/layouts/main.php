<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\auctions\models\Auctions;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]>
    <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en"> <!--<![endif]-->
    <head>


        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon -->
        <link rel="shortcut icon" href="/favicon.ico">


        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?= Html::csrfMetaTags() ?>

    </head>

    <body class="header-fixed">

    <?php $this->beginBody() ?>
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
            </div>
            <!--/container-->
        </div>
        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <a class="navbar-brand" href="/">
                        <img id="logo-header" src="/img/logo.png" alt="Logo" style="margin-top: -10px;">
                    </a>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">


                    <?php  echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                            ['label' => 'Главная', 'url' => ['/']],
                            ['label' => 'Аукционы', 'url' => ['/auctions/']],
                            ['label' => 'Магазин', 'url' => \yii\helpers\Url::to('https://shop.imperial-k.ru')],
                            ['label' => 'Контакты', 'url' => \yii\helpers\Url::to('/contact')],
                            ['label' => 'Филиалы', 'url' => \yii\helpers\Url::to('/filials')],
                            (Yii::$app->user->identity->role == 20) ?
                                ['label' => 'Админпанель', 'url' => \yii\helpers\Url::to('/admin')] : '',
                        ],
                    ]);
                    ?>
                </div>
                <!--/navbar-collapse-->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v5 ===-->


    <!--=== Content Part ===-->
    <div class="content container-fluid">
        <div class="col-md-12">
            <div class="row row-content">
                <div class="imperial-buttons" style="display: none;z-index: 100009;">
                    <i class="fa fa-search-plus"></i>
                    <i class="fa fa-search-minus"></i>
                    <i class="fa fa-close"></i>
                </div>


                <div class="col-md-2 filter-by-block md-margin-bottom-60">


                    <div class="panel-group" id="accordion-v4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                        Профайл
                                </h2>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <?= app\components\LoginWidget::widget() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/end panel group-->

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                        Текущие аукционы
                                </h2>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="list-unstyled checkbox-list">
    
                                        <?php foreach (Auctions::find()->where("closing_date>NOW() AND `show`=10")->orderBy('opening_date DESC')->all() as $auct): ?>
                                            <li><?= Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id]) ?></li>
                                            <li style="font-size: 12px;">Начало закрытия
                                                <?php $date = new DateTime($auct->opening_date);
                                                echo $date->format('d.m.Y H:i:s');?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/end panel group-->

                    <div class="panel-group" id="accordion-v2" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                   Закрытые аукционы
                                </h2>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body" style="height:200px;overflow-y:scroll;overflow-x: hidden;">
                                    <ul class="list-unstyled checkbox-list">
                                        <?php $item = 0; ?>
                                        <?php foreach (Auctions::find()->where('`show`=10 AND closing_date<=NOW()')->orderBy('closing_date DESC')->all() as $auct): ?>
                                            <?php if ($item < 6):?>
                                            <li><?= Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id]) ?> </li>
                                            <?php else:?>
                                            <li><?= Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id],['class'=>'links-auct']) ?> </li>
                                            <?php endif;?>
                                            <?php $item++;?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <!--<div id="auction-links" style='font-family:"Open Sans",sans-serif;color:#687074;cursor:pointer;'>...больше...</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/end panel group-->

                    <div class="panel-group" id="accordion-v3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                   Информация
                                </h2>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="list-unstyled checkbox-list">
                                        <li><?= Html::a('Новости', ['/news']) ?></li>
                                        <li><?= Html::a('Правила', ['/site/rule']) ?></li>
                                        <li><?= Html::a('Контакты', ['/contact']) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/end panel group-->

                </div>

                <div class="col-md-10 content-main-area">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>
<div style="position: absolute; top:5px; right: 20px; font-size: 16pt;">
                        <h6 style="margin:0;">Время на сервере</h6>
                        <i class="fa fa-clock-o fa-6" style="font-size: 22px;"></i>
                    <strong><a href="//24timezones.com/ru_vremia/moscow_mestnoe_vremia.php" style="text-decoration: none;" class="clock24" id="tz24-1580211253-c1166-eyJob3VydHlwZSI6IjI0Iiwic2hvd2RhdGUiOiIwIiwic2hvd3NlY29uZHMiOiIxIiwic2hvd3RpbWV6b25lIjoiMSIsInR5cGUiOiJkIiwibGFuZyI6InJ1In0=" title="Москва часы" target="_blank" rel="nofollow"></a></strong>
<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
</div>

                    <?= \app\widgets\Alert::widget() ?>
                    <?= $content ?>

                </div>
            </div>
            <!--/end row-->
        </div>
    </div>
    <!--/end container-->
    <!--=== End Content Part ===-->


    <!--=== Footer v4 ===-->
    <?= \app\components\FooterWidget::widget()?>

    <!--=== End Footer v4 ===-->
    </div>
    <!--/wrapper-->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>