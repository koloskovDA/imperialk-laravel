<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Lots */

$this->title = $model->nominal;
$this->params['breadcrumbs'][] = ['label' => $model->auction->name, 'url' => ['/auctions/auctions/'.$model->auction->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($model->nominal) ?></h1>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'image',
                        'value'=>'/upload/lots/'.$model->image,
                        'format' => ['image',['width'=>'100','height'=>'100']],
                    ],
                    'number',
                    'nominal',
                    'year',
                    'letter',
                    'metal',
                    'saves'
                ],
            ]) ?>


        </div>
        <div class="col-md-6">
            <h2>История ставок</h2>
            <table class="table table-striped table-bordered detail-view">
                <thead>
                   <th>Псевдоним</th>
                   <th>Ставка</th>
                   <th>Время</th>

                </thead>
                <tbody>


              <?php foreach($historyLots as $hlot):?>
                  <tr>
                      <td><?= $hlot->user->username ?></td>
                      <td><?= $hlot->sum ?></td>
                      <td><?= $hlot->create_date ?></td>

                  </tr>
              <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <table class="table table-striped table-bordered detail-view">
                <tbody>
                <tr><th>Текущая цена</th><td><?= $model->getCurrentPrice() ?></td></tr>
                <tr><th>Лидер</th><td><?= $model->getLeader() ?></td></tr>
                <tr><th>Количество ставок</th><td><?= $count ?></td></tr>
                <tr><th>Время закрытия</th><td><?= $model->closing_date ?></td></tr>
                 </tbody>
            </table>

          <?php if(!Yii::$app->user->isGuest):?>
            <?php $form = ActiveForm::begin([
                'method'=>'post',
                'action' => ['historylots/addrate'],
                //'enableAjaxValidation'=>true,
            ]);?>

            <span class="pull-right">
                <?php if($model->isProfileLot()):?>
                    <?= Html::a('Удалить из профайла',['lots/removeprofilelot','id'=>$model->id])?>

                <?php else:?>
                    <?= Html::a('Добавить в профайл',['lots/addprofilelot','id'=>$model->id])?>
                <?php endif;?>
            </span>
            <p>Минимальная сумма для ставки <span id="minRateSum"><?= $model->getMinimumRate()?></span> руб.</p>
            <?= $form->field($hlModel, 'sum')->textInput() ?>
            <?= $form->field($hlModel, 'lot_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
            <?= $form->field($hlModel, 'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>


            <div class="form-group">
                <?= Html::submitButton('Поставить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end();?>


              <?php if($refererTrue):?>
                  <h3>Поставить всю сумму сразу</h3>
                  <?php $form = ActiveForm::begin([
                      'method'=>'post',
                      'action' => ['historylots/addprofilesum'],
                      //'enableAjaxValidation'=>true,
                  ]);?>

                  <?= $form->field($prModel, 'sum')->textInput() ?>


                  <div class="form-group">
                      <?= Html::submitButton('Поставить', ['class' => 'btn btn-success']) ?>
                  </div>

                  <?php ActiveForm::end();?>
              <?php endif;?>
           <?php else:?>
              <div style="color:red; text-align:center;margin-top:10px;font-size:13px;">
                  Вам необходимо войти или
                  <a href="/site/signup" style="color:red; text-decoration:underline;">
                      зарегистрироваться</a>,<br> чтобы принимать участие в аукционе
              </div>
           <?php endif;?>

        </div>
    </div>
</div>


