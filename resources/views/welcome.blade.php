@extends('site.layouts.guest')

@section('title', __('Home'))

@section('main')
    @include('site.components.welcome-page.hero')
    @include('site.components.welcome-page.solutions')
    @include('site.components.welcome-page.pricing')
    @include('site.components.welcome-page.contact')
@endsection
