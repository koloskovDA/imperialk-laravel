<?php
use yii\bootstrap\Carousel;
use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;



$this->title = 'My Yii Application';
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top: 5px;">
    <div class="carousel-inner">


        <div class="item active">
            <img alt="First slide" src="/img/img1.jpg" >
            <div class="carousel-caption">
                <h3>Интернет-аукцион</h3>
            </div>
        </div>
        <div class="item">
            <img alt="First slide" src="/img/img2.jpg" >
            <div class="carousel-caption">
                <h3>Нумизматический салон</h3>
            </div>
        </div>

        <div class="item">
            <img alt="First slide" src="/img/img3.jpg" >
            <div class="carousel-caption">
                <h3>Интернет-магазин</h3>
            </div>
        </div>

    </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left fa fa-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right fa fa-chevron-right"></span>
    </a>
</div>




<?php if (Yii::$app->session->hasFlash('testSuccess')): ?>
    <?php
    Alert::begin([
    'options' => [
    'class' => 'alert-warning',
    ],
    ]);

    echo 'Say hello...';

    Alert::end();
    ?>

<?php endif; ?>
    <div class="heading heading-v1 margin-bottom-40">
        <h2>Выставленные лоты</h2>
    </div>
<div class="row margin-bottom-30">
<?php foreach($lastLots as $lot):?>
<div class="col-md-3 col-sm-6" >
    <div class="product-lots" style="margin-bottom:10px;border: 1px solid #DDDDDD;border-bottom: 1px solid #DDDDDD;text-align: center;">
    <div class="product-img">
        <a href="<?= Url::to(['/auctions/lots/'.$lot->id])?>">
            <img src="<?= $lot->show(127,127) ?>" />

            <img src="<?= $lot->showBackImage(127,127) ?>" />
<!--            <img class="full-width img-responsive" src="--><?php //echo $lot->show(263,253) ?><!--" style="max-height: 253px;" alt=""></a>-->
        </a>
    </div>
    <div class="product-description product-description-brd">
        <div class="overflow-h margin-bottom-5">
            <h4 class="title-price" style="font-size: 14px;">
            <a href="<?= Url::to(['/auctions/lots/'.$lot->id])?>"><?= StringHelper::truncate($lot->nominal,25); ?></a>
            </h4>

        </div>



        <div class="product-price">

            <span class="title-price"><? $lot->price ?></span>
        </div>

    </div>
    </div>
</div>

<?php endforeach;?>
</div>
<div class="clearfix"></div>
    <div class="heading heading-v1 margin-bottom-40">
        <h2>Последние товары</h2>
    </div>
<div class="row margin-bottom-30">
<?php foreach($lastProducts as $prod):?>
    <div class="col-md-4 col-sm-6 md-margin-bottom-30">
        <div class="product">
            <div class="product-img">
                <a href="<?= Url::to('https://shop.imperial-k.ru/product/'.$prod->id)?>">
                    <img class="full-width img-responsive" src="http://imperial-k.ru/<?= $prod->show(333,165) ?>" alt=""></a>

            </div>
            <div class="product-description product-description-brd">
                <div class="overflow-h margin-bottom-5">

                    <h4 class="title-price">
                        <a href="<?= Url::to('https://shop.imperial-k.ru/product/'.$prod->id)?>"><?= $prod->name  ?></a>
                    </h4>

                    <div class="price">

                        <span><?= $prod->price ?> руб.</span>
                    </div>


                </div>
                <div class="product-price">
                    <span class="title-price"><? $prod->price ?></span>
                </div>

            </div>
        </div>
    </div>
<?php endforeach;?>
   </div>