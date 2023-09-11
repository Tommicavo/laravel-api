<div class="d-flex justify-content-between align-items-center my-3">
    <div class="buttonsLeft d-flex justify-content-center align-items-center gap-3">
        <a class="btn btn-primary" href="{{ route('admin.home') }}">
            <span><i class="fa-solid fa-house-user"></i></span>
            <span>Home</span>
        </a>
        <a class="btn btn-primary" href="{{ route('admin.types.index') }}">
            <span><i class="fa-solid fa-rotate-left"></i></span>
            <span>Back</span>
        </a>
    </div>
    <div class="d-flex justify-content-between align-items-center my-3">
        <div class="buttonsRight d-flex justify-content-center align-items-center gap-3">
            <button type="reset" class="btn btn-primary">
                <span><i class="fa-solid fa-eraser"></i></span>
                <span>Empty all Fields</span>
            </button>
            <button type="submit" class="btn btn-success">
                <span><i class="fa-solid fa-floppy-disk"></i></span>
                <span>Save Type</span>
            </button>
        </div>
    </div>
</div>
