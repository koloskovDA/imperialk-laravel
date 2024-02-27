<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\ProfileLots */

$this->title = 'Update Profile Lots: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-lots-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
