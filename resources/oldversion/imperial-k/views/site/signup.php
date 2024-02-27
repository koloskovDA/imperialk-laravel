<style>
    div.required label:after {
        content: " *";
    }
</style>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title);?></h1>

    <div class="row">
        <?php if (Yii::$app->session->hasFlash('registerSuccess')): ?>

            <div class="alert alert-success">
                Спасибо большое за регистрацию.Мы отправили письмо с активацией на ваш электронный адрес.
            </div>

        <?php else: ?>

        <div class="col-lg-5">



            <?php $form = ActiveForm::begin([
                'id'=>'form-signup',
               // 'enableAjaxValidation'=>true,
            ]);?>
                 <?= $form->field($model,'username')?>
                 <?= $form->field($model,'email')?>
                 <?= $form->field($model,'password')->passwordInput()?>
                 <?= $form->field($model,'firstname')?>
                 <?= $form->field($model,'lastname')?>
                 <?= $form->field($model,'patronym')?>
                 <?= $form->field($model,'address')?>
                 <?= $form->field($model,'phone1')?>
                 <?= $form->field($model,'phone2')?>
            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end();?>
        </div>
            <?php endif;?>

    </div>
</div>
