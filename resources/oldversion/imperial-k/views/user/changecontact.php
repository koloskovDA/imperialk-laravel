<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h2>Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

<h1>Изменить контакты</h1>
<?php if (Yii::$app->session->hasFlash('changeSuccess')): ?>

    <div class="alert alert-success">
        Ваши контакты обновлены.
    </div>

<?php else:?>
<?php $form = ActiveForm::begin(['id'=>'changecontact']);?>
    <?= $form->field($model,'email')?>
    <?= $form->field($model,'address')?>
    <?= $form->field($model,'phone1') ?>
    <?= $form->field($model,'phone2')?>

    <div class="form-group">
        <?= Html::submitButton('Потвердить изменения',['class'=>'btn btn-primary'])?>
    </div>
<?php ActiveForm::end();?>
<?php endif; ?>

<?= Html::a('В профайл',['/user/profile'],['class'=>'btn btn-info'])?>