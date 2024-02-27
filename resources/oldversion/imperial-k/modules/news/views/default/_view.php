<?php
  use yii\helpers\Html;
?>
<div class="news-item col-md-12" style="padding-bottom: 20px;margin-bottom:10px;border-bottom: 1px solid #B29A65;">
    <div class="row">
     <span class="time pull-left"><?= \Yii::$app->formatter->asDatetime($model->created_at, "php:d-m-y"); ?></span>
    </div>

    <div class="row">
    <?php if($model->img !== ''):?>
        <?= Html::img($model->show(120,120),['class'=>'pull-left','style'=>'margin-right:10px;'])?>
    <?php endif;?>

    <div class="news-item-body">
        <?= $model->content ?>
        <?= Html::a('Подробнее',['view','id'=>$model->id])?>
    </div>
    </div>
</div>