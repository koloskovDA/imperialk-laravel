<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\PaymentHistory */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Payment Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">


        <div class="box-body">

            <?=
            $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>