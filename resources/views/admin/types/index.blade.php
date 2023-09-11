@extends('layouts.app')

@section('title', 'Types')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1 class="text-center py-4">Types</h1>
        <a class="btn btn-success" href="{{ route('admin.types.create') }}">
            <span><i class="fa-regular fa-square-plus"></i></span>
            <span>Add New Type</span>
        </a>
    </header>
    <div class="indexContent">
        <table class="table mb-4">
            <thead>
                @if ($types->isNotEmpty())
                    <tr>
                        <th scope="col" colspan="1" width="20%">#</th>
                        <th scope="col" colspan="1" width="35%">Label</th>
                        <th scope="col" colspan="1" width="20%">Color</th>
                        <th class="text-center" scope="col" colspan="1" width="25%">Tasks</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->label }}</td>
                        <td>
                            <div class="typesColor" style="background-color: {{ $type->color }}"></div>
                        </td>
                        <td>
                            @include('includes.types.index.buttons')
                        </td>
                    </tr>
                @empty
                    <div>No Types yet...</div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/confirmDelete.js')
@endsection
