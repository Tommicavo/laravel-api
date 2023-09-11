@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
    <h1 class="text-center py-4">My Projects</h1>
    <header class="d-flex justify-content-between align-items-center mb-3">
        <div class="headerLeft">
            @include('includes.generics.searchbar')
        </div>
        <div class="headerRight d-flex justify-content-center align-items-center gap-3">
            <a class="btn btn-success" href="{{ route('admin.projects.create') }}">
                <span><i class="fa-regular fa-square-plus"></i></span>
                <span>Create New Project</span>
            </a>
            <a class="btn btn-danger" href="{{ route('admin.projects.trash') }}">
                <span><i class="fa-solid fa-trash-arrow-up"></i></span>
                <span>Open Trash Can</span>
            </a>
        </div>
    </header>
    <div class="indexContent">
        @include('includes.generics.projectsTable')
    </div>
@endsection

@section('scripts')
    @vite('resources/js/confirmDelete.js')
    @vite('resources/js/dragAndDrop.js')
    @vite('resources/js/toggleForm.js')
@endsection
