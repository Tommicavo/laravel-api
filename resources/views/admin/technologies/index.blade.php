@extends('layouts.app')

@section('title', 'Technologies')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1 class="text-center py-4">Technologies</h1>
        <a class="btn btn-success" href="{{ route('admin.technologies.create') }}">
            <span><i class="fa-regular fa-square-plus"></i></span>
            <span>Add New Technology</span>
        </a>
    </header>
    <div class="indexContent">
        <table class="table mb-4">
            <thead>
                @if ($technologies->isNotEmpty())
                    <tr>
                        <th scope="col" colspan="1" width="20%">#</th>
                        <th scope="col" colspan="1" width="35%">Label</th>
                        <th scope="col" colspan="1" width="20%">Color</th>
                        <th class="text-center" scope="col" colspan="1" width="25%">Tasks</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                        <td>{{ $technology->label }}</td>
                        <td>
                            <div class="typesColor bg-{{ $technology->color }}"></div>
                        </td>
                        <td>
                            @include('includes.technologies.index.buttons')
                        </td>
                    </tr>
                @empty
                    <div>No Technologies yet...</div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/confirmDelete.js')
@endsection
