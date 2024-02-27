<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h2 style="font-size: 16px;">Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>


<h1>Ваши заочные биды</h1>

<?php if(!empty($showBids)):?>
<table class="table table-striped table-responsive table-bordered table-hover auctions-lots">
    <thead>
    <tr>
        <th>Лот</th>
        <th>Номинал</th>
        <th>Изобр.</th>
        <th>Год</th>
        <th>Буквы</th>
        <th>Металл</th>
        <th>Ставки</th>
        <th>Цена</th>
        <th>Лидер</th>
        <th>Закрытие</th>
        <th>Ваш бид</th>

    </tr>
    </thead>

    <tbody>
    <?php foreach($showBids as $lot):?>
        <tr>
            <td><?= $lot->lot->pos ?></td>
            <td  class="nominal-td" data-url="<?= Url::to(['/auctions/lots/'.$lot->lot->id]) ?>"><?= Html::a($lot->lot->nominal,['/auctions/lots/'.$lot->lot->id]) ?></td>
            <td  style="width:20%;padding:1px;">
                <?= Html::img($lot->lot->show(60,60),['width'=>50,'height'=>50])?>
                <?= Html::img($lot->lot->showBackImage(60,60),['width'=>50,'height'=>50])?>
            </td>
            <td><?= $lot->lot->year ?></td>
            <td><?= $lot->lot->letter ?></td>
            <td><?= $lot->lot->metal ?></td>
            <td><?= $lot->lot->getHistoryLots()->count() ?></td>
            <td><?= $lot->lot->getLeader() ?></td>
            <td><?= $lot->lot->price ?></td>
            <td><?= $lot->lot->closing_date ?></td>
            <td>
                <?php if($lot->sum<$lot->lot->price): ?>
                    Превышен
                <?php else:?>
                    Нет
                <?php endif;?>

            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
    <h2>Заочных бидов не установлено</h2>
<?php endif;?>

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

JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>