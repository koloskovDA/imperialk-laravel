<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'История изменения счета';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->profile->firstname.' '.$user->profile->lastname, 'url' => ['view','id'=>Yii::$app->request->get('id')]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>


<div class="col-xs-12">
    <div class="box">
        <div class="box-header">

        </div>


        <div class="box-body">
          <?=
              \yii\grid\GridView::widget([
                  'dataProvider' => $dataProvider,
                  'columns'=>[
                      'created_at',
                      [
                          'label'=>'Обоснование',
                          'attribute'=>'text',
                          'value'=>$data->text,

                      ],
                      [
                          'label'=>'Сумма операции',
                          'attribute'=>'sum',
                          'value'=>$data->sum,
                      ],

                      [
                          'label'=>'Остаток',
                          'value'=>function ($data){
                                  return $data->balance;
                              }
                      ],
                      [
                      'class' => 'yii\grid\ActionColumn',
                      'controller'=>'backend/paymenthistory',
                      'template'=>'{delete}',
                  ],
                  ]
              ])
          ?>

          <?= Html::a('Добавить',['/auctions/backend/paymenthistory/create','user_id'=>$user->id],['class'=>'btn btn-success'])?>

        </div>
    </div>



