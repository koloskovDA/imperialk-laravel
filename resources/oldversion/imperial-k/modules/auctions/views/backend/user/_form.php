<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

?>

<div class="auctions-form col-md-5">
    <h3>Данные пользователя </h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'username') ?>
    <?= $form->field($model,'email') ?>
    <?= $form->field($model,'nickname') ?>


    <?= $form->field($model, 'status')->dropDownList([User::STATUS_DELETED =>'Заблокировать',User::STATUS_ACTIVE=>'Разблокировать']) ?>

    <?= $form->field($model,'role')->dropDownList([User::ROLE_ADMIN => 'Администратор',User::ROLE_MODER => 'Модератор', User::ROLE_USER=>'Пользователь'],['promt'=>'Выберите роль'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="col-md-5">
    <h3>Контактные данные пользователя </h3>

    <?php $formContact = ActiveForm::begin([
    ])?>

    <?= $form->field($modelProfile,'address') ?>
    <?= $form->field($modelProfile,'phone1') ?>
    <?= $form->field($modelProfile,'phone2') ?>

    <?php ActiveForm::end();?>

</div>
