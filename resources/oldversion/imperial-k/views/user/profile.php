<?php
use yii\helpers\Html;

?>
<h1>Профайл: <?= $model->username ?></h1>


<div class="row profile">
    <div class="col-md-6">

        <p><span>Логин : <?= $model->username ?></span></p>

        <p><span>Текущий псевдоним : <?= $model->nickname ?></span></p>

        <p><?= Html::a('Изменить псевдоним', ['/user/changenick']) ?></p>


        <p><?= Html::a('Лоты в профайле', ['/user/showfav']) ?></p>

        <p><?= Html::a('Показать выигранные лоты', ['/user/winlots']) ?></p>

        <p><?= Html::a('Показать биды', ['/user/showbids']) ?></p>
        
        <p><?= Html::a('Мои лоты', ['/user/assignlots']) ?></p> 

        <h3>Личный кабинет</h3>


        <p><?= Html::a('Изменить контакты', ['/user/changecontact']) ?></p>

        <p><?= Html::a('Изменить пароль', ['site/request-password-reset']) ?></p>
        <?php $link = 'Сообщения(' . $newMessagesCount . ')'; ?>
        <p><?= Html::a($link, ['/messages/inbox']) ?></p>

    </div>
    <div class="col-md-6">

        <p><span>Количество выигранных лотов: <b><?= $model->winlotsCount ?></b></span></p>

        <p>
            <span>Выигранно лотов на сумму: <b><?= ($model->allcost === null) ? 0 : Yii::$app->formatter->asDecimal($model->allcost, 0) ?>
                    руб.</b></span></p>

        <p><span>Ваш комиссионный процент:<?= $model->payment->commission ?>%</span></p>

        <p><span>Сумма по текущим аукционам: <?= $currentSum ?> руб.</span></p>

        <p></p><?= Html::a('История изменения счета', ['/user/history']) ?></p>

    </div>
</div>