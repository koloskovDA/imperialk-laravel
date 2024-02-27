<?php
use yii\helpers\Html;

$this->title = 'Редактирование: ' . ' ' . $model->username;
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body">

        <?= $this->render('_form', [
            'model' => $model,
            'modelProfile'=>$modelProfile,
        ]) ?>
    </div>

</div>
