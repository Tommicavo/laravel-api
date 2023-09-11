@if (!$searchFilter && !$selectFilter)
    <div class="emptyData text-center my-5">
        <h3 class="py-4">Seems like your project repository is empty...</h3>
        <div>
            <a class="btn btn-success fw-bold" href="{{ route('admin.projects.create') }}">Create your
                first
                project!</a>
        </div>
    </div>
@else
    <div class="emptyData text-center my-5">
        <h3 class="py-4">Seems like this search provided no results...</h3>
    </div>
@endif
