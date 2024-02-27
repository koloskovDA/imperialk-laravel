<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h2>Результаты Аукциона №<?= $name ?></h2>
Уважаемый <?= Html::encode($user->username)?>!


<p>Выигранные Вами лоты на аукционе №<?= $name ?>:</p> 
<table border="1" bordercolor="black" cellpadding="5" cellspacing="1"><tr><td><strong>Номинал</strong></td><td><strong>Год</strong></td><td><strong>Буквы</strong></td><td><strong>Металл</strong></td>
<td><strong>Сохр.</strong></td><td><strong>Цена</strong></td></tr><?= $sum ?></table>
<hr>
<p><strong>Итого: </strong><?= $value ?> рублей с учётом комиссии.</p>
