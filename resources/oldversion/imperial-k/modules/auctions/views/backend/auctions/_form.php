<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\modules\auctions\models\Auctions;


/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Auctions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auctions-form col-md-5">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255])->label('Аукцион №') ?>
    <?= $form->field($model, 'show')->dropDownList([
        Auctions::SHOW_CLOSE=>'Не выставлен',
        Auctions::SHOW_OPEN=>'Выставлен',
    ]) ?>



    <?php
    echo $form->field($model, 'opening_date')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>
    <div class="clearfix"></div>

<!--    --><?php
//    echo $form->field($model, 'closing_date')->widget(DateTimePicker::class, [
//        'options' => ['placeholder' => 'Enter event time ...'],
//        'pluginOptions' => [
//            'autoclose' => true,
//            'format' => 'yyyy-mm-dd HH:ii:ss'
//        ]
//    ]);
//    ?>

    <div class="form-group">
                <?php
                $data = date('Y-m-d');
                $date = $model->closing_date;
                if($data <= $date || $date == ''):?>
                    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php else:?>
                    <?= Html::a('Закрыть', ['/auctions/backend/auctions'], ['class'=>'btn btn-danger']) ?>
                <?php endif;?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
