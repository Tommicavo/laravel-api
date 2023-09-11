<div class="indexButtons d-flex justify-content-center gap-3">
    <a class="btn btn-warning" href="{{ route('admin.technologies.edit', $technology->id) }}">
        <i class="fa-solid fa-pen-clip"></i>
    </a>
    <form class="formDelete trashTechnology" action="{{ route('admin.technologies.destroy', $technology->id) }}"
        method="POST" data-name="{{ $technology->label }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
</div>
