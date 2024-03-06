@extends('admin.index')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Аукционы</h1>
@stop

@section('content')
    @livewire('admin.auctions')
@stop
