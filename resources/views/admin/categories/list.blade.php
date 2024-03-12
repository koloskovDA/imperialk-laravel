@extends('admin.index')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Категории</h1>
@stop

@section('content')
    @livewire('admin.categories')
@stop
