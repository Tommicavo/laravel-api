@extends('layouts.app')

@section('title', 'Trash Can')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <div class="headerLeft d-flex justify-content-center align-items-center gap-3">
            <h1 class="text-center py-4">Trash Can</h1>
        </div>
        <div class="headerRight d-flex justify-content-center align-items-center gap-3">
            <a class="btn btn-primary" href="{{ route('admin.home') }}">
                <span><i class="fa-solid fa-house-user"></i></span>
                <span>Home</span>
            </a>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">
                <span><i class="fa-solid fa-backward-fast"></i></span>
                <span>Projects</span>
            </a>
            <form class="formDelete eraseAllProjects" action="{{ route('admin.projects.dropAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
                    <span><i class="fa-solid fa-explosion"></i></span>
                    <span>Erase All</span>
                </button>
            </form>
        </div>
    </header>
    <div class="trashContent">
        <table class="table">
            <thead>
                @if ($projects->isNotEmpty())
                    <tr>
                        <th scope="col" colspan="1" width="50%">Title</th>
                        <th class="text-center" scope="col" colspan="1" width="50%">Tasks</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>
                            @include('includes.projects.trash.buttons')
                        </td>
                    </tr>
                @empty
                    <div class="emptyData text-center my-5">
                        <h3 class="py-4">Seems like Trash Can is empty...</h3>
                        <div>
                            <a class="btn btn-primary fw-bold" href="{{ route('admin.projects.index') }}">
                                <span><i class="fa-solid fa-rotate-left"></i></span>
                                <span>Back to my Projects</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection()

@section('scripts')
    @vite('resources/js/confirmDelete.js')
@endsection
