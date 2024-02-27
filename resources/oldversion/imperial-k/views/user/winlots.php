<?php
use yii\helpers\Html;
use app\components\ArrayHelper;

?>
    <h2 style="font-size: 16px;">Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

    <h1>Ваши выигранные лоты</h1>
<?php //if($currentAuction):?>
<?//= Html::a($currentAuction->getAuctionName(),['/user/winlots'])?>
<!--    &nbsp;|&nbsp;-->
<?php //endif;?>
<?//= Html::a('Закрытые аукционы',['/user/winlots','auction_id'=>$lastCloseAuctions->id])?>
<?php //if(isset($auctionId)):?>
<!--    &nbsp;:&nbsp;-->
<?//= Html::dropDownList('auction_id',$auctionId,ArrayHelper::mapAuct($closeAuctions,'id','name'),['id'=>'auction_id']) ?>
<?php //endif;?>

Выберите аукцион
<?php if(isset($auctionId)):?>
    &nbsp;:&nbsp;
<?= Html::dropDownList('auction_id',$auctionId,ArrayHelper::mapAuct($closeAuctions,'id','name'),['id'=>'auction_id']) ?>
<?php endif;?>

    <table class="table table-striped table-bordered table-hover winlots">
        <thead>
        <tr>
            <th>Лот</th>
            <th>Номинал</th>
            <th>Изображение</th>
            <th>Год</th>
            <th>Буквы</th>
            <th>Металл</th>
            <th>Состояние</th>
            <th>Ставки</th>
            <th>Цена</th>
            <th>Лидер</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($winlots as $lot):?>
            <tr>
                <td><?= $lot->lot->pos ?></td>
                <td><?= Html::a($lot->lot->nominal,['/auctions/lots/'.$lot->lot->id]) ?></td>
                <td>
                    <?= Html::img($lot->lot->show(60,60),['width'=>60,'height'=>60])?>
                    <?= Html::img($lot->lot->showBackImage(60,60),['width'=>60,'height'=>60])?>
                </td>
                <td><?= $lot->lot->year ?></td>
                <td><?= $lot->lot->letter ?></td>
                <td class="mettal-td"><?= $lot->lot->metal ?></td>
                <td><?= $lot->lot->saves ?></td>
                <td><?= $lot->lot->getHistoryLots()->count() ?></td>
                <td><?= Yii::$app->formatter->asDecimal($lot->lot->price, 0); ?></td>
                <td><?= $lot->lot->getLeader() ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>


<?= Html::a('В профайл',['/user/profile'],['class'=>'btn btn-info'])?>

<?php
$script = <<< JS
     $('#auction_id').on('change', function(e) {
            var id = $(this).val();
            document.location.href= ("/user/winlots?auction_id="+ id);

     });
JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>