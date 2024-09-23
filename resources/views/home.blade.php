@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
   <img src="{{ asset('img/1.jpg') }}" alt="Image Alt Text" style="width: 100%;">
@endsection
