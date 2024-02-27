<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\ArrayHelper;
?>
<h2 style="font-size: 16px;">Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

<h1>Мои лоты</h1>

<div style="margin-bottom: 20px">
<?php if($currentAuction):?>
<?= Html::a($currentAuction->getAuctionName(),['/user/showfav'])?>
    &nbsp;|&nbsp;
<?php endif;?>
<?= Html::a('Закрытые аукционы',['/user/assignlots','auction_id'=>$lastCloseAuctions->id])?>

<?php if(isset($auctionId)):?>
    &nbsp;:&nbsp;
<?= Html::dropDownList('auction_id',$auctionId,ArrayHelper::mapAuct($closeAuctions,'id','name'),['id'=>'auction_id']) ?>
<?php endif;?>
</div>



<table class="table table-striped table-responsive table-bordered table-hover auctions-lots">
    <thead>
    <tr>
        <th>Лот</th>
        <th>Номинал</th>
        <th>Изображение</th>
        <th>Год</th>
        <th>Буквы</th>
        <th>Металл</th>
        <th>Ставки</th>
        <th>Цена</th>
        <th>Лидер</th>



    </tr>
    </thead>
    <tbody>
    <?php foreach($assignLots as $lot):?>
        <tr>

            <td><?= $lot->lot->pos ?></td>
            <td class="nominal-td" data-url="<?= Url::to(['/auctions/lots/'.$lot->lot->id]) ?>"><?= Html::a($lot->lot->nominal,['/auctions/lots/'.$lot->lot->id]) ?></td>
            <td class="image-block">
                 <?= Html::img($lot->lot->show(60,60),['width'=>60,'height'=>60])?>
                 <?= Html::img($lot->lot->showBackImage(60,60),['width'=>60,'height'=>60])?>
            </td>
            <td><?= $lot->lot->year ?></td>
            <td><?= $lot->lot->letter ?></td>
            <td><?= $lot->lot->metal ?></td>
            <td><?= $lot->lot->getHistoryLots()->count() ?></td>
            <td><?= \Yii::$app->formatter->asDecimal($lot->lot->price,0) ?></td>
            <td><?= $lot->lot->getLeader() ?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?= Html::a('В профайл',['/user/profile'],['class'=>'btn btn-info'])?>


<?php
$script = <<< JS
     $(".auctions-lots tbody tr td").css('cursor','pointer');
     $(".auctions-lots tbody tr td").on('click',function(e){
          var url = $(this).siblings('.nominal-td').attr('data-url');
          if(url===undefined){
              url = $(this).attr('data-url');
          }
          document.location.href = url;
     });

     $('#auction_id').on('change', function(e) {
            var id = $(this).val();
            document.location.href= ("/user/assignlots?auction_id="+ id);

     });
JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>