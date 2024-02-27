<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Auctions */

$this->title = 'Добавить аукцион';
$this->params['breadcrumbs'][] = ['label' => 'Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
