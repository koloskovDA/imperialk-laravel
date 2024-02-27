<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?=
       \yii\widgets\ListView::widget([
           'dataProvider' => $dataProvider,
           'itemView' => '_view',
           'layout'=>"{items}\n{pager}",
       ])
    ?>

</div>
