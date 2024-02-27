<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form col-md-7">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ratePercent')->textInput() ?>
    <? $form->field($model, 'skype')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'contact_text')->textarea(['rows' => 6,'cols'=>10]) ?>

    <h4>Администрация</h4>
    <?= $form->field($model, 'admin_email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'admin_phone1')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'admin_phone2')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'admin_mode')->textInput(['maxlength' => 255]) ?>

    <h4>Экспертиза</h4>
    <?= $form->field($model, 'expertise_email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'expertise_phone')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'expertise_mode')->textInput(['maxlength' => 255]) ?>

    <h4>Вопросы взаиморасчетов</h4>
    <?= $form->field($model, 'question_email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'question_phone')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'question_mode')->textInput(['maxlength' => 255]) ?>

    <h4>Реквизиты на оплату лотов:</h4>
    <?= $form->field($model, 'payment_options')->textArea() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
