<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Auctions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Аукционы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">

<?php if (\Yii::$app->session->hasFlash('successAuctionResult')): ?>

    <div class="alert alert-success">
        <?= \Yii::$app->session->getFlash('successAuctionResult'); ?>
    </div>
<?php endif;?>

            <p>
                <?php
                $data = date('Y-m-d');
                $date = $model->closing_date;
                if($data < $date):?>
                    <?= Html::a('<i class="fa fa-plus"></i> Добавить лот', ['/auctions/backend/lots/create','auction_id'=>$model->id], ['class' => 'btn btn-success']) ?>
                <?php endif;?>
            </p>

            <p>
                <?php if($data < $date):?>
                <?= Html::a('<i class="fa fa-arrows"></i> Расположить',['#'],['id'=>'sortButton','class'=>'btn btn-info']) ?>
                <?php endif;?>
                <?php if(!$btnResult):?>
                <?= Html::a('<i class="fa fa-bar-chart"></i> Cформировать отчет аукциона', ['result','auction_id'=>$model->id], ['class' => 'pull-right btn btn-success']) ?>
                <?php endif;?>
            </p>
        </div>
        <div class="box-body">
            <?=
            GridView::widget([
                'id'=>'lots-grid',
                'dataProvider' => $lotsProvider,
                'layout' => "{pager}\n{summary}\n {items}\n{pager}",
                'rowOptions'=>function($model, $key, $index, $grid){
                        return ['style'=>'cursor:pointer','class' => 'items[]_'.$model->id,'data-class'=>'items[]_'.$model->id];
                },
                'columns' => [

                    'pos',
                    [
                        'attribute' => 'nominal',
                        'format' => 'raw',
                        'value' => function ($data) {

                                return Html::a($data->nominal, ['lots/view', 'id' => $data->id]);
                            }
                    ],
                    [
                        'label' => 'Изображение',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return Html::img($data->show(30,30),['width'=>30,'height'=>30]).Html::img($data->showBackImage(30,30),['width'=>30,'height'=>30]).Html::a('<span class="glyphicon glyphicon-pencil"></span>',['backend/lots/updatephotos','id'=>$data->id]);
                            }
                    ],
                    'year',
                    'letter',
                    'metal',
                    [
                        'label' => 'Филиал',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return $data->getFilial();
                            }
                    ],
                    'saves',
                    'owner',
                   // 'category_id',
                    [
                        'label' => 'Ставки',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return $data->getHistoryLots()->count();
                            }
                    ],

                    [
                        'label' => 'Лидер',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return $data->getLeader();
                            },
                    ],

                   [
                      'attribute'=>'price',
                      'format'=>'raw',
                      'value'=>function($data){
                              return \Yii::$app->formatter->asDecimal($data->getCurrentPrice(), 0);
                          }
                   ],

                    // 'image',
                    // 'created_date',
                   // 'close_time',
                    'closing_date',
                    [
                        'format'=>'raw',
                        'value'=>function($data){
                             $out = '<a name="'.$data->id.'"></a>';
                             $out .= Html::a('на главную',Url::to(['/auctions/backend/lookup/add','id'=>$data->id,'type'=>'lots']));
                             return $out;
                        }

                    ],

                    // 'publisher_draft',
                    // 'auction_id',
                    // 'category_id',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller'=>'backend/lots',
                        'template'=>'{photoedit}{update}{delete}',
                        'buttons'=>[
                            'photoedit'=>function($url,$model){
                                $customUrl = Url::to(['/auctions/backend/lots/photos','id'=>$model->id]);
                                return Html::a('<span class="glyphicon glyphicon-picture"></span>',$customUrl);

                            }
                        ],
                    ],
                ],
            ]); ?>


        </div>

    </div>
</div>
<?php
$str_js = "

   $('#sortButton').on('click',function(e){
      e.preventDefault();
      var ser = $('#lots-grid table tbody').sortable('serialize',{key:'items[]',
                                                                       attribute:'data-class'
                                                                       });

      $.ajax({
                'url': '".Url::to(['sort'])."',
                'type': 'post',
                'data': ser,
                'success': function(data){

                     location.reload();

                },
                'error':function(request,status,error){
                    alert('Error');
                }
      });

   });


    var fixHelper = function(e,ui) {
        ui.children().each(function(){
            $(this).width($(this).width());
        });
        return ui;
    };


    $('#lots-grid table tbody').sortable({
        forcePlaceholderSize:true,
        forceHelperSize: true,
        items: 'tr',
        update : function() {
            serial = $('#lots-grid table tbody').sortable('serialize',{key:'items[]',
                                                                       attribute:'data-class'
                                                                       });


            $.ajax({
                'url': '".Url::to(['sort'])."',
                'type': 'post',
                'data': serial,
                'success': function(data){
                     location.reload();

                },
                'error':function(request,status,error){
                    alert('Error');
                }
            });
        },
        helper: fixHelper
    }).disableSelection();
";
?>
<?php
   $this->registerJsFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js',['position'=>View::POS_END,'depends'=>'yii\web\YiiAsset']);
   $this->registerJs($str_js, View::POS_END);
?>