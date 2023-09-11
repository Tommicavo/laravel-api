@if ($project->exists)
    {{-- Edit form --}}
    <h1 class="text-center py-4">Edit {{ $project->title }}</h1>
    <div class="editContent">
        <form action=" {{ route('admin.projects.update', $project->id) }} " method="POST" enctype="multipart/form-data">
            @method('PUT')
        @else
            {{-- Create form --}}
            <h1 class="text-center py-4">Add a New Project</h1>
            <div class="createContent">
                <form action=" {{ route('admin.projects.store') }} " method="POST" enctype="multipart/form-data">
@endif

@csrf
{{-- title --}}
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text"
        class="form-control @error('title') is-invalid @elseif(old('title')) is-valid @enderror"
        id="title" placeholder="Write Title..." name="title" value=" {{ old('title', $project->title) }} ">
    @error('title')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- image --}}
<div class="d-flex justify-content-between align-items-center gap-4 mb-3">
    <div class="imgPath">
        <label for="image" class="form-label">Image file</label>

        {{-- <div class="input-group mb-3 @if (!$project->image) d-none @endif" id="fakeImageField">
            <button class="btn btn-outline-secondary" type="button" id="chooseFileBtn">Choose file</button>
            <input type="text" class="form-control" value="{{ $project->image }}">
        </div> --}}

        <input type="file"
            class="form-control @error('image') is-invalid @elseif(old('image')) is-valid @enderror"
            id="image" name="image">
        @error('image')
            <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>
    <div class="imgPreview">
        <div class="previewContainer d-flex flex-column justify-content-center">
            <label for="imagePreview" class="form-label">Image Preview</label>
            <img src="{{ $project->image ? $project->getImagePath() : asset('storage/noFile.png') }}" alt=""
                id="imagePreview">
        </div>
    </div>
</div>

{{-- description --}}
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text"
        class="form-control @error('description') is-invalid @elseif(old('description')) is-valid @enderror"
        placeholder="Write Description..." name="description" value=" {{ old('description', $project->description) }} ">
    @error('description')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- is_published --}}
<div class="mb-3">
    <label class="form-label">Status</label>
    <div class="form-check form-switch">
        <label for="is_published" class="form-label">Publish</label>
        <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published"
            value="1" @if (old('is_published', $project->is_published)) checked @endif>
    </div>
    @error('is_published')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- type_id --}}
<div class="input-group mb-3">
    <label class="input-group-text" for="type">Project Type: </label>
    <select class="form-select @error('type_id') is-invalid @elseif(old('type_id')) is-valid @enderror"
        id="type" name="type_id">
        <option value="">Select a project type...</option>
        @foreach ($types as $type)
            <option @if (old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}"> {{ $type->label }}
            </option>
        @endforeach
    </select>
    @error('type_id')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- technologies --}}
<div class="mb-3">
    <label class="form-label">Technologies: </label>
    @foreach ($technologies as $technology)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                id="technology_{{ $technology->id }}" @if (in_array($technology->id, old('technologies', $project_technology_ids ?? []))) checked @endif
                name="technologies[]">
            <label class="form-check-label" for="technology_{{ $technology->id }}">{{ $technology->label }}</label>
        </div>
    @endforeach
    @error('technologies')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

@if ($project->exists)
    @include('includes.projects.edit.buttons')
@else
    @include('includes.projects.create.buttons')
@endif

</form>
</div>
