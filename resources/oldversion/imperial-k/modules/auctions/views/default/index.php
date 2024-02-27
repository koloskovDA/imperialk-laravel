<?php
use yii\helpers\Html;
 $this->title = 'Империал-К :: Аукционы';
?>
<h1>Новости аукциона</h1>

<?php foreach($lastNews as $news): ?>
<!--    <div class="news-item">-->
<!--     <span class="time">-->
<!--         <i class="fa fa-clock-o"></i>-->
<!--         --><?//= $news->created_at ?>
<!--     </span>-->
<!--     <h3>--><?//= $news->name ?><!--</h3>-->
<!--        <div class="row">-->
<!--            --><?php //if($news->img !== ''):?>
<!--                --><?//= Html::img($news->show(120,120),['class'=>'pull-left','style'=>'margin-right:10px;'])?>
<!--            --><?php //endif;?>
<!--      <div class="news-item-body">-->
<!--          --><?//= $news->content ?>
<!--      </div>-->
<!--    </div>-->
<!--        </div>-->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(50613823, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/50613823" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <div class="news-item col-md-12" style="padding-bottom: 20px;margin-bottom:10px;border-bottom: 1px solid #B29A65;">
        <div class="row">
            <span class="time pull-left"><?= \Yii::$app->formatter->asDatetime($news->created_at, "php:d-m-y"); ?></span>
        </div>

        <div class="row">
            <?php if($news->img !== ''):?>
                <?= Html::img($news->show(120,120),['class'=>'pull-left','style'=>'margin-right:10px;'])?>
            <?php endif;?>

            <div class="news-item-body">
                <?= $news->content ?>
                <?= Html::a('Подробнее',['/news/default/view','id'=>$news->id])?>
            </div>
        </div>
    </div>
<?php endforeach;?>
