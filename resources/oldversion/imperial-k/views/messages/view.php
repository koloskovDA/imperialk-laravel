<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
?>
<h2>Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

<h1>Сообщения</h1>

<section class="content">
    <!-- MAILBOX BEGIN -->
    <div class="mailbox row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            use yii\bootstrap\Modal;

                            Modal::begin(['id' => 'modal',
                                'header' => '<h2>Новое сообщение</h2>']);
                            ?>
                            <?php $modelNew = new \app\models\Messages();?>
                            <?php $form = ActiveForm::begin([
                                'action' => ['messages/create']
                            ]); ?>
                            <?= $form->field($modelNew, 'user_to')->hiddenInput(['value'=>8])->label(false) ?>
                            <?= $form->field($modelNew, 'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>
                            <?= $form->field($modelNew, 'text')->textarea(['rows' => 6]) ?>

                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Сохранить', ['class' => $modelNew->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <?php Modal::end();
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4">

                            <!-- compose message btn -->
                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal">
                                <i class="fa fa-pencil"></i> Написать сообщение</a>
                            <!-- Navigation - folders-->
                            <div style="margin-top: 15px;">
                                <ul class="nav nav-pills nav-stacked">

                                    <li>
                                        <?= Html::a("<i class='fa fa-inbox'></i> Входящие",['inbox'],['style'=>'padding:0px;'])?>
                                    </li>
                                    <li class="active"><i class="fa fa-mail-forward"></i> Отправленные</li>
                                </ul>
                            </div>
                        </div><!-- /.col (LEFT) -->
                        <div class="col-md-9 col-sm-8">
                                 <?= $model->text ?>


                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col (MAIN) -->
        </div>
        <!-- MAILBOX END -->

</section>
