<?php
use yii\helpers\Html;
?>
<div class="footer-v4">
    <div class="footer">

        <div class=" <?php if($type == 1):?> container-fluid <?php else:?> container <?php endif;?>">
            <div class="col-md-12">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-5">
                        <h2 class="thumb-headline">Администрация</h2>

                        <ul class="list-unstyled address-list">
                            <li><i class="fa fa-angle-right"></i>Россия, г. Сургут, ул. Энтузиастов 59а, ТЦ "Восход"</li>
                            <li><i class="fa fa-phone"></i>8 (922) 652-75-17</li>
                            <li><i class="fa fa-envelope"></i>koloskov.a@mail.ru</li>
                        </ul>
                    </div>


                    <!-- End About -->

                    <!-- Simple List -->
                    <div class="col-md-3 col-sm-4">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Экспертиза</h2>
                                <ul class="list-unstyled simple-list">
                                    <li><i class="fa fa-phone"></i> 8 (922) 652-75-17</li>
                                    <li><i class="fa fa-envelope"></i> koloskov.a@mail.ru</li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- Simple List -->
                    <div class="col-md-2 col-sm-4">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Аукционы</h2>
                                <ul class="list-unstyled simple-list">

                                    <li><?= Html::a('Новости',['/news'])?></li>
                                    <li><?= Html::a('Правила',['/site/rule'])?></li>
                                    <li><?= Html::a('Контакты',['/contact'])?></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Магазин</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><?= Html::a('Категории',\yii\helpers\Url::to('http://shop.imperial-k.ru'))?></li>
                                    <li><?= Html::a('Продукты',\yii\helpers\Url::to('http://shop.imperial-k.ru'))?></li>

                                </ul>
                                <!-- Yandex.Metrika counter -->
                                <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter30746078 = new Ya.Metrika({
                    id:30746078,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
                                <noscript><div><img src="https://mc.yandex.ru/watch/30746078" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                                <!-- /Yandex.Metrika counter -->
                            </div>

                        </div>
                    </div>

                    <!-- End Simple List -->
                </div><!--/end row-->
            </div>
        </div>

        <!--/end continer-->
    </div>
    <!--/footer-->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span class="side_menu" style="margin-left:30px;">©&nbsp;Copyright 2015</span>
                    </p>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    <!--/copyright-->
</div>