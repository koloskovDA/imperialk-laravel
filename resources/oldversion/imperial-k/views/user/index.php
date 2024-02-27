<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

<h1>Пользователи</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,

    'columns' => [
        'id',
        [
            'attribute'=>'username',
            'format'=>'raw',
            'value'=>function($data){
                    return Html::a($data->username,['user/profile','id'=>$data->id]);
            }
        ],
        'username',
        'email',

    ],
]); ?>