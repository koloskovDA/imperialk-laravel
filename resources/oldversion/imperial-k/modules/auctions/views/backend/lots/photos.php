<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Фотографии';

$this->params['breadcrumbs'][] = ['label' => 'Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nominal, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>

<div class="box">
    <div class="box_body">
        <div class="lots-form col-md-5">

            <?php foreach ($model->photoLots as $photo):?>
               <div class="row">
                   <div class="col-md-12">
                       <?= Html::img($photo->getImage(),['style'=>''])?>
                       <?= Html::a('<span class="glyphicon glyphicon-remove"></span>',\yii\helpers\Url::to(['/auctions/backend/photolots/delete','id'=>$photo->id]))?>

                   </div>
               </div>

            <?php endforeach;?>

        <h3>Добавить новую фотографию</h3>
        <?php $formPhoto = ActiveForm::begin([
            'action'=>\yii\helpers\Url::to(['/auctions/backend/photolots/create']),
            'options'=>['enctype'=>'multipart/form-data']
        ]) ?>
        <?= $formPhoto->field($modelPhoto,'src')->fileInput() ?>
        <?= $formPhoto->field($modelPhoto,'lot_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
        <?= Html::submitButton('Загрузить',['class'=>'btn btn-info'])?>

        <?php ActiveForm::end();?></div>
    </div>
</div>