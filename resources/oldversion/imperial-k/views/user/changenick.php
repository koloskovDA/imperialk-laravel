<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h2>Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

<h1>Смена псевдонима</h1>

<?php if (Yii::$app->session->hasFlash('changeNickSuccess')): ?>

    <div class="alert alert-success">
        Вы сменили ваш псевдоним.
    </div>

<?php else: ?>

<?php $form = ActiveForm::begin(['id'=>'changenick']);?>
    <div class="alert alert-info" role="alert">
        <strong>Текущий псевдоним </strong> <?= Yii::$app->user->identity->nickname ?>
    </div>
<?= $form->field($model,'nickname') ?>

    <div class="form-group">
        <?= Html::submitButton('Потвердить изменения',['class'=>'btn btn-primary'])?>
    </div>
<?php ActiveForm::end();?>

<?php endif;?>

<?= Html::a('В профайл',['/user/profile'],['class'=>'btn btn-info'])?>