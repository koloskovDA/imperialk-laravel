<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Usershop */

$this->title = 'Create Usershop';
$this->params['breadcrumbs'][] = ['label' => 'Usershops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usershop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
