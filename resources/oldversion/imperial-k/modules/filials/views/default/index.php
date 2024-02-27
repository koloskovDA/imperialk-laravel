<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Филиалы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="news-index">
    <div class="news-index">
        <h1>Видеоархив</h1>
            <video width="550" height="309" controls>
                <source src="news16.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
            </video>
            <video width="550" height="309" controls>
                <source src="7,5 монеты 2.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
            </video>
            <video width="550" height="309" controls>
                <source src="Untitled.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
            </video>
            <video width="550" height="309" controls>
                <source src="Untitled245.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
            </video>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

<!--     <?=
       \yii\widgets\ListView::widget([
           'dataProvider' => $dataProvider,
           'itemView' => '_view',
           'layout'=>"{items}\n{pager}",
       ])
    ?> -->


                <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                 //   'name',
                    [
                       'label'=>'Город',
                       'format'=>'raw',
                       'value'=>function($data){
                       	   return Html::a($data->name,['view','id'=>$data->id]);
                       }
                    ],
                    'info:ntext',
                ],
            ]); ?>

</div>