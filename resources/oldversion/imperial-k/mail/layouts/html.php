<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <div style="width: 580px; padding: 25px; margin: auto; border: solid 1px #A3A3A9; box-shadow: 0 0 10px rgba(0,0,0,0.5); background-color: #F0F0F0;">
        <p align="center" style="margin: 0px;">
            <a href="https://xn----7sbolbofe1al.xn--p1ai/"><img src="https://xn----7sbolbofe1al.xn--p1ai/img/logo.png"></a>
        </p>
        <?php $this->beginBody() ?>
        <hr>
        <p>
            <?= $content ?>
        </p>
        <hr>
        <p><em>&laquo;Аукционный дом Империал-К&raquo; <br>
        г. Сургут, Югорский тракт 38 <br>
        8(3462)93-55-99</em></p>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
