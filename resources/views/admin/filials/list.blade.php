@extends('admin.index')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Филиалы</h1>
@stop

@section('content')
    @livewire('admin.filials')
@stop
