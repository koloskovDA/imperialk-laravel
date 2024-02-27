@extends('layouts.main')
@section('content')
    <div class="row row-content">
        @include('layouts.left-nav')
        <div class="col-md-10 content-main-area">
            <?php
            /*echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);*/
            ?>

            <h1>Lorem ipsum</h1>
        </div>
    </div>
@endsection
