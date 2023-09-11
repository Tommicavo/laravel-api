@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1 class="py-3">Welcome back, {{ Auth::user()->name }}!</h1>
        <h3 class="py-3">Community Project-list:</h3>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @include('includes.generics.projectsTable')
                        <div class="btnContainer d-flex justify-content-center">
                            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Go to my
                                Projects!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/confirmDelete.js')
    @vite('resources/js/dragAndDrop.js')
    @vite('resources/js/toggleForm.js')
@endsection
