<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
?>

<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id'=>'request-password-reset-form']);?>
            <?= $form->field($model,'email') ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить',['class'=>'btn btn-primary'])?>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>

