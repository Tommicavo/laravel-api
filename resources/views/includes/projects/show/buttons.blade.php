<div class="showButtons d-flex justify-content-between">
    <div class="buttonsLeft d-flex justify-content-center align-items-center gap-3">
        <a class="btn btn-primary" href="{{ route('admin.home') }}">
            <span><i class="fa-solid fa-house-user"></i></span>
            <span>All Projects</span>
        </a>
        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">
            <span><i class="fa-solid fa-backward-fast"></i></span>
            <span>My Projects</span>
        </a>
    </div>
    <div class="buttonsMiddle d-flex justify-content-center align-items-center gap-3">
        <a class="btn btn-info" href="{{ route('admin.projects.show', $prevProject->id) }}">
            <span><i class="fa-solid fa-backward-step"></i></span>
            <span>Prev</span>
        </a>
        <a class="btn btn-info" href="{{ route('admin.projects.show', $nextProject->id) }}">
            <span>Next</span>
            <span><i class="fa-solid fa-forward-step"></i></span>
        </a>
    </div>
    @if (Auth::id() === $project->user_id)
        <div class="buttonsRight d-flex justify-content-center align-items-center gap-3">
            <form method="POST" action="{{ route('admin.projects.toggle', $project->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="btn {{ $project->is_published ? 'btn-secondary' : 'btn-success' }}">{{ $project->is_published ? 'Save as Draft' : 'Publish' }}</button>
            </form>
            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">
                <span><i class="fa-solid fa-pen-clip"></i></span>
                <span>Edit</span>
            </a>
            <form class="formDelete trashProject" action="{{ route('admin.projects.destroy', $project->id) }}"
                method="POST" data-name="{{ $project->title }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
                    <span><i class="fa-solid fa-trash-can"></i></span>
                    <span>Delete</span>
                </button>
            </form>
        </div>
    @endif
</div>
