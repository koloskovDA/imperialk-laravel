<div class="imperial-buttons" style="display: none;z-index: 100009;">
    <i class="fa fa-search-plus"></i>
    <i class="fa fa-search-minus"></i>
    <i class="fa fa-close"></i>
</div>
<div class="col-md-2 filter-by-block md-margin-bottom-60">
    <div class="panel-group" id="accordion-v4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Профайл
                </h2>
            </div>
            <div id="collapseFour" class="panel-collapse collapse in">
                <div class="panel-body">
                    <form id="login-form-widget" action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-group field-loginform-username required has-success">
                            <label class="control-label" for="loginform-username">Логин</label>
                            <input type="text" id="loginform-username" class="form-control" name="email">

                        </div><div class="form-group field-loginform-password required has-success">
                            <label class="control-label" for="loginform-password">Пароль</label>
                            <input type="password" id="loginform-password" class="form-control" name="password">

                        </div><div class="form-group field-loginform-rememberme">

                            <input type="hidden" name="remember" value="0"><label><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="" wfd-id="id5"> Запомнить меня</label>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="col-md-offset-1 col-md-10 btn btn-primary" name="login-button">Войти</button></div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Забыли пароль</a> <br>
                        @endif
                        <a href="{{route('register')}}">Регистрация</a></form>


                </div>
            </div>
        </div>
    </div>
    <!--/end panel group-->

    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Текущие аукционы
                </h2>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <ul class="list-unstyled checkbox-list">

                        <?php /*foreach (Auctions::find()->where("closing_date>NOW() AND `show`=10")->orderBy('opening_date DESC')->all() as $auct): ?>
                                        <li><?= Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id]) ?></li>
                                        <li style="font-size: 12px;">Начало закрытия
                                                <?php $date = new DateTime($auct->opening_date);
                                                echo $date->format('d.m.Y H:i:s');?></li>
                                        <?php endforeach;*/ ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/end panel group-->

    <div class="panel-group" id="accordion-v2" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Закрытые аукционы
                </h2>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body" style="height:200px;overflow-y:scroll;overflow-x: hidden;">
                    <ul class="list-unstyled checkbox-list">
                        <!--
                         $item = 0;
                        foreach (Auctions::find()->where('`show`=10 AND closing_date<=NOW()')->orderBy('closing_date DESC')->all() as $auct): ?>
                            if ($item < 6):?>
                        <li> Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id]) ?> </li>
                         else:?>
                        <li> Html::a($auct->getAuctionName(), ['/auctions/auctions/' . $auct->id],['class'=>'links-auct']) ?> </li>
                         endif;?>
                             $item++;?>
                        endforeach; ?>
                        -->

                    </ul>
                    <!--<div id="auction-links" style='font-family:"Open Sans",sans-serif;color:#687074;cursor:pointer;'>...больше...</div>-->
                </div>
            </div>
        </div>
    </div>
    <!--/end panel group-->

    <div class="panel-group" id="accordion-v3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Информация
                </h2>
            </div>
            <div id="collapseThree" class="panel-collapse collapse in">
                <div class="panel-body">
                    <ul class="list-unstyled checkbox-list">
                        <li>Новости</li>
                        <li>Правила</li>
                        <li>Контакты</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/end panel group-->

</div>
