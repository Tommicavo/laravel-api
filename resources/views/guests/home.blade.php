@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="text-center py-4">Portfolio</h1>
    <div class="guestsHomeContent">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2500">
                    <img src="{{ Vite::asset('resources/img/gray.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h5>Your Projects Repository</h5>
                        <p>Store your projects in Portfolio and consult them everywhere</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2500">
                    <img src="{{ Vite::asset('resources/img/gray.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h5>Save your Project</h5>
                        <p>Upload your latest projects and store them into a database</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2500">
                    <img src="{{ Vite::asset('resources/img/gray.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h5>Editing</h5>
                        <p>Modify images and description of your projects</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="buttons d-flex justify-content-center align-items-center gap-3 my-4">
            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
            <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>
@endsection
