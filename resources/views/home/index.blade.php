@extends('_layouts.app')

@section('title'){{ __('Welcome') }}@endsection

@section('description'){{ __('Welcome') }}@endsection

@section('content')
    <section class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple << information by applications >></p>
        <p>Don't hesitate to expand this below dump.</p>
        <hr class="my-4">
        @php(dump($informationsByApplication))
    </section>
@endsection
