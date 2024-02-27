<?php
use yii\grid\GridView;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute'=>'lot_id',
            'format'=>'raw',
            'value'=>function($data){
                    return $data->lot->nominal;
             }
        ],
        [
            'attribute'=>'user_id',
            'format'=>'raw',
            'value'=>function($data){
                    return $data->user->username;
             }
        ],

        'sum',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>