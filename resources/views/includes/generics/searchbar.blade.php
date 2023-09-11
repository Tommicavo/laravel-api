<form action="{{ route('admin.projects.index') }}" method="GET" class="d-flex justify-content-center align-items-center">
    <div class="input-group">
        <select class="form-select publishFilter" name="publishFilter">
            <option value="">All Projects</option>
            <option value="published" @if ($publishFilter === 'published') selected @endif>Publish</option>
            <option value="drafts" @if ($publishFilter === 'drafts') selected @endif>Drafts</option>
        </select>
    </div>
    <div class="input-group">
        <select class="form-select typeFilter" name="typeFilter">
            <option value="">All Types</option>
            @foreach ($types as $type)
                <option @if ($typeFilter == $type->id) selected @endif value="{{ $type->id }}">
                    {{ $type->label }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search a project..." name="searchFilter"
            value="{{ $searchFilter }}" autofocus>
    </div>
    <button class="btn btn-primary findBtn" type="submit">Find</button>
</form>
