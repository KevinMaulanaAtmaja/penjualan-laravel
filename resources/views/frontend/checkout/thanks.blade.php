@extends('frontend.dashboard.index')
@section('content')
    <section class="pt-5 pb-5 section osahan-not-found-page">
        <div class="container">
            <div class="row">
                <div class="pt-5 pb-5 text-center col-md-12">
                    <img class="img-fluid" src="{{ asset('frontend/img/404.png') }}" alt="404">
                    <h1 class="mt-2 mb-2">Order Complete Thanks </h1>
                    <p> </p>
                    <a class="btn btn-primary btn-lg" href="{{ url('/') }}">GO HOME</a>
                </div>
            </div>
        </div>
    </section>
@endsection
