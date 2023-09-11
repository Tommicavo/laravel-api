<div class="indexButtons d-flex justify-content-center gap-3">
    <a class="btn btn-warning" href="{{ route('admin.types.edit', $type->id) }}">
        <i class="fa-solid fa-pen-clip"></i>
    </a>
    <form class="formDelete trashType" action="{{ route('admin.types.destroy', $type->id) }}" method="POST"
        data-name="{{ $type->label }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
</div>
