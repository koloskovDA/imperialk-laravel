<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\search\AuctionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auctions-search">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
    ]); ?>


    <?= $form->field($model, 'name') ?>


    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
