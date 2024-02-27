<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-5 col-md-offset-3">



    <?php $form = ActiveForm::begin([
        'id' => 'sky-form1',
        'options' => ['class' => 'log-reg-block sky-form'],
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
       $field = $form->field($model, 'username');
       echo $field->begin();
    ?>
    <section>
    <label class="input login-input no-border-top">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <?php echo Html::activeTextInput($model,'username',['class'=>'form-control']);?>
            </div>
        </label>
    </section>
    <?php
    $field->end();
    ?>
    <?php
        $field = $form->field($model, 'password');
        echo $field->begin();
    ?>
    <section>
        <label class="input login-input no-border-top">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <?php echo Html::activePasswordInput($model,'password',['class'=>'form-control']);?>
            </div>
        </label>
    </section>

    <?php
    $field->end();
    ?>

    <div class="row margin-bottom-5">
        <div class="col-xs-6">
            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>
        </div>
        <div class="col-xs-6 text-right">

            <?= Html::a('Забыли пароль', ['site/request-password-reset']) ?>
        </div>
    </div>

            <?= Html::submitButton('Вход', ['class' => 'btn-u btn-u-sea-shop btn-block margin-bottom-20', 'name' => 'login-button']) ?>


    <?php ActiveForm::end(); ?>
    </div>


