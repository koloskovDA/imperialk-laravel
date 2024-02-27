<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    @vite([
        'resources/oldversion/css/header-v5.css',
        'resources/oldversion/js/app.js',
        'resources/oldversion/js/shop.app.js',
        'resources/js/app.js',
        'resources/oldversion/js/bootstrap.min.js',
        'resources/oldversion/css/bootstrap.css',
        'resources/oldversion/css/shop.style.css',
        'resources/oldversion/css/line-icons.css',
        'resources/oldversion/css/perfect-scrollbar.css',
        'resources/oldversion/css/jquery.nouislider.css',
    ])
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        body.shimeji-pinned iframe {
            pointer-events: none;
        }
        body.shimeji-select-ie {
            cursor: cell !important;
        }
        #shimeji-contextMenu::-webkit-scrollbar {
            width: 6px;
        }
        #shimeji-contextMenu::-webkit-scrollbar-thumb {
            background-color: rgba(30,30,30,0.6);
            border-radius: 3px;
        }
        #shimeji-contextMenu::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="header-fixed">
<div class="wrapper">
    @php
        if(\Illuminate\Support\Facades\URL::current() !== 'http://imperial-k.test')
            $array = ['content' => 'content container-fluid', 'row' => 'row row-content', 'col' => 'col-md-10 content-main-area', 'include' => true];
        else
            $array = ['content' => 'content container', 'row' => 'row', 'col' => 'col-md-12', 'include' => false];
    @endphp

    @include('layouts.navbar')
    <div class="{{$array['content']}}">
        <div class="{{$array['row']}}">
            @if($array['include'])
                @include('layouts.left-nav')
            @endif
            <div class="{{$array['col']}}">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
</body>
</html>
