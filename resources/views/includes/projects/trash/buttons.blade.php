<div class="trashButtons d-flex justify-content-center align-items-center gap-3">
    <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button class="btn btn-success" type="submit">
            <span><i class="fa-solid fa-recycle"></i></span>
            <span>Restore</span>
        </button>
    </form>
    <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
        <span><i class="fa-solid fa-info"></i></span>
        <span>Info</span>
    </a>
    <form class="formDelete eraseProject" action="{{ route('admin.projects.drop', $project->id) }}" method="POST"
        data-name="{{ $project->title }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
            <span><i class="fa-solid fa-trash-can"></i></span>
            <span>Erase</span>
        </button>
    </form>
</div>
