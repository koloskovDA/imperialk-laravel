<?php

use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pages\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form col-md-10">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>


    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>


<?php
    echo $form->field($model, 'content')->widget(CKEditor::class,[
    'editorOptions' => [
    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
    ]]);
?>


    <?= $form->field($model, 'h1_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
