<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row margin-bottom-30">
    <div class="col-md-8 mb-margin-bottom-30">

       <h1><?= $this->title ?></h1>

        <?= $settings->contact_text ?>

        <div id="map" class="map map-box map-box-space margin-bottom-40" style="position: relative; overflow: hidden;">
            <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Jun3b5TWhfNKJYLcaLvsgZ9n04vqbW8b&width=700&height=450"></script>

        </div>

        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

            <div class="alert alert-success">
                Thank you for contacting us. We will respond to you as soon as possible.
            </div>

        <?php else: ?>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        <?php endif; ?>
    </div><!--/col-md-9-->

    <div class="col-md-4">
        <!-- Администрация -->
        <div class="headline">
            <h2>Администрация</h2>
        </div>
        <ul class="list-unstyled who margin-bottom-30">

            <li><i class="fa fa-envelope"></i>  <?= $settings->admin_email ?></li>
            <li><i class="fa fa-phone"></i>  <?= $settings->admin_phone1 ?></li>
            <li><i class="fa fa-phone"></i>  <?= $settings->admin_phone2 ?></li>
            Режим работы : <?= $settings->admin_mode ?>
        </ul>

        <!-- Экспертиза-->
        <div class="headline">
            <h2>Экспертиза</h2>
        </div>
        <ul class="list-unstyled who margin-bottom-30">
            <li><i class="fa fa-envelope"></i>  <?= $settings->expertise_email ?></li>
            <li><i class="fa fa-phone"></i>  <?= $settings->expertise_phone ?></li>
            Режим работы : <?= $settings->expertise_mode ?>
        </ul>

        <div class="headline">
            <h2>Вопросы взаиморасчетов</h2>
        </div>
        <ul class="list-unstyled who margin-bottom-30">

            <li><i class="fa fa-envelope"></i>  <?= $settings->question_email ?></li>
            <li><i class="fa fa-phone"></i>  <?= $settings->question_phone ?></li>
            Режим работы : <?= $settings->question_mode ?>
        </ul>

        <div class="headline">
            <h2>Реквизиты</h2>

        </div>
        <ul class="list-unstyled who margin-bottom-30">
             <li><?= $settings->payment_options ?></li>
        </ul>


    </div><!--/col-md-3-->
</div>


<div class="site-contact">

</div>
