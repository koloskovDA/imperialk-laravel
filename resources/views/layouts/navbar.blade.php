<div class="header-v5 header-static">

    <div class="topbar-v3">
        <div class="search-open">
            <div class="container">
                <input type="text" class="form-control" placeholder="Search">
                <div class="search-close"><i class="icon-close"></i></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Topbar Navigation -->

                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!--/container-->
    </div>
    <!-- Navbar -->
    <div class="navbar navbar-default mega-menu" role="navigation">
        <div @if(\Illuminate\Support\Facades\URL::current() !== 'http://imperial-k.test') class="container-fluid" @else class="container" @endif>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="/">
                    <img id="logo-header" src="https://imperial-k.ru/img/logo.png" alt="Logo" style="width: 270px; height: 78px; margin-top: -10px;">
                </a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">



                <ul id="w0" class="navbar-nav navbar-right nav"><li class="active"><a href="/">Главная</a></li>
                    <li><a href="/auctions">Аукционы</a></li>
                    <li><a href="https://shop.imperial-k.ru">Магазин</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="/filials">Филиалы</a></li>
                </ul>            </div><!--/navbar-collapse-->
        </div>
    </div>
    <!-- End Navbar -->
</div>
