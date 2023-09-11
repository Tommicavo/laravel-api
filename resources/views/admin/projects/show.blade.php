@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <h1 class="text-center py-4">{{ $project->title }}</h1>
    <div class="showContent">
        <div class="card">
            <div class="card-header d-flex gap-5">
                @if ($project->image)
                    <img src="{{ $project->getImagePath() }}" class="card-img-top" alt="{{ $project->title }}">
                @endif
                <div class="cardInfo">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <div class="created">
                        <span><strong>Created:</strong></span>
                        <span>{{ $project->created_at }}</span>
                    </div>
                    <div class="created">
                        <span><strong>Last Updated:</strong></span>
                        <span>{{ $project->updated_at }}</span>
                    </div>
                    <div class="is_published">
                        <span><strong>Status:</strong></span>
                        <span>{{ $project->is_published ? 'Pubblicato' : 'Bozza' }}</span>
                    </div>
                    <div class="type_id">
                        <span><strong>Project Type:</strong></span>
                        <span>{{ $project->type->label }}</span>
                    </div>
                    <div class="author">
                        <span><strong>Author:</strong></span>
                        <span>{{ $project->author ? $project->author->name : 'Anonimus' }}</span>
                    </div>
                </div>
                <div class="cardTechnologies">
                    <h5 class="card-title">Technologies:</h5>
                    <div class="technologies">
                        @forelse ($project->technologies as $technology)
                            <div class="techColor badge rounded-pill text-bg-{{ $technology->color }}">
                                {{ $technology->label }}</div>
                        @empty
                            <div class="techColor badge rounded-pill text-bg-dark">
                                <span><i class="fa-solid fa-triangle-exclamation text-warning"></i></span>
                                <span>No Technology assigned yet</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $project->description }}</p>
            </div>
            <div class="card-footer">
                @include('includes.projects.show.buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/confirmDelete.js')
@endsection
