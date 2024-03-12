@extends('admin.index')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Лоты аукциона {{$auction->name}}</h1>
@stop

@section('content')
    @livewire('admin.lots', ['auction' => $auction])
@stop
