<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menus */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
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
