<div class="indexButtons d-flex justify-content-center gap-3">
    <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
        <i class="fa-solid fa-eye"></i>
    </a>
    @if (Auth::id() === $project->user_id)
        <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">
            <i class="fa-solid fa-pen-clip"></i>
        </a>
        <form class="formDelete trashProject" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
            data-name="{{ $project->title }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </form>
    @else
        <a class="btn btn-warning lockedBtn" href="#"><i class="fa-solid fa-pen-clip"></i></a>
        <a class="btn btn-danger lockedBtn" href="#"><i class="fa-solid fa-trash-can"></i></a>
    @endif
</div>
