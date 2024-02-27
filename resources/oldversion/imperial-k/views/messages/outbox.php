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
                            <?php $model = new \app\models\Messages();?>
                            <?php $form = ActiveForm::begin([
                                'action' => ['messages/create']
                            ]); ?>
                            <?= $form->field($model, 'user_to')->hiddenInput(['value'=>1])->label(false) ?>
                            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>
                            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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

                            <div class="table-responsive">

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'tableOptions' =>['class' => 'table table-striped table-bordered table-mailbox'],

                                    'columns' => [
                                        'date',
                                        [
                                            'attribute'=>'text',
                                            'format'=>'raw',
                                            'value'=>function($data){
                                                    return Html::a(\yii\helpers\StringHelper::truncate($data->text,50),['/messages/'.$data->id]);
                                                }
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{delete}',
                                        ],


                                    ],
                                ]); ?>




                            </div><!-- /.col (RIGHT) -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col (MAIN) -->
        </div>
        <!-- MAILBOX END -->

</section>