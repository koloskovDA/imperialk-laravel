<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
$this->title = 'Ваши выигранные лоты';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->profile->firstname.' '.$user->profile->lastname, 'url' => ['view','id'=>Yii::$app->request->get('id')]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>


<div class="col-xs-12">
    <div class="box">
    <div class="box-header">
        <h1>Ваши выигранные лоты</h1>
    </div>


    <div class="box-body">
<?= Html::a($currentAuction->name,['/auctions/backend/user/winlots','id'=>Yii::$app->request->get('id')])?>
    &nbsp;|&nbsp;
<?= Html::a('Закрытые аукционы',['/auctions/backend/user/winlots','id'=>Yii::$app->request->get('id'),'auction_id'=>$lastCloseAuctions->id])?>
    &nbsp;:&nbsp;
<?= Html::dropDownList('auction_id',$auctionId,ArrayHelper::map($closeAuctions,'id','name'),['id'=>'auction_id']) ?>

    <table class="table table-striped table-bordered table-hover">
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
                <td><?= $lot->lot->metal ?></td>
                <td><?= $lot->lot->saves ?></td>
                <td><?= $lot->lot->getHistoryLots()->count() ?></td>
                <td><?= Yii::$app->formatter->asDecimal($lot->lot->price, 0); ?></td>
                <td><?= $lot->lot->getLeader() ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    </div>

<?php
$script = <<< JS
     $('#auction_id').on('change', function(e) {
     	    var tmp = new Array();
            var tmp2 = new Array();
            var param = new Array();
            var auctionId = $(this).val();
            var get = document.location.search;
            if(get != ''){
                tmp = (get.substr(1)).split('&');
                for(var i=0; i < tmp.length; i++){
                    tmp2 = tmp[i].split('=');
                    param[tmp2[0]] = tmp2[1];
                }
            }

            var id = param['id'];

            document.location.href= ("/auctions/backend/user/winlots?id=" + id + "&auction_id="+ auctionId);

     });
JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>
