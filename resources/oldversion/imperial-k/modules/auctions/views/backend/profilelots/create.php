<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\ProfileLots */

$this->title = 'Create Profile Lots';
$this->params['breadcrumbs'][] = ['label' => 'Profile Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-lots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
