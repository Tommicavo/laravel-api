@if ($type->exists)
    {{-- Edit form --}}
    <h1 class="text-center py-4">Edit {{ $type->title }} type</h1>
    <div class="editContent">
        <form action=" {{ route('admin.types.update', $type->id) }} " method="POST">
            @method('PUT')
        @else
            {{-- Create form --}}
            <h1 class="text-center py-4">Add a New Type</h1>
            <div class="createContent">
                <form action=" {{ route('admin.types.store') }} " method="POST">
@endif

@csrf
{{-- label --}}
<div class="mb-3">
    <label for="typeLabel" class="form-label">Label</label>
    <input type="text"
        class="form-control @error('label') is-invalid @elseif(old('label')) is-valid @enderror"
        id="typeLabel" placeholder="Write label..." name="label" value=" {{ old('label', $type->label) }} ">
    @error('label')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- color --}}
<div class="mb-3">
    <label for="typeColor" class="form-label">Pick Color</label>
    <input type="color"
        class="form-control form-control-color @error('color') is-invalid @elseif(old('color')) is-valid @enderror"
        id="typeColor" value="{{ old('color', $type->color) }}" name="color">
    @error('color')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

@if ($type->exists)
    @include('includes.types.edit.buttons')
@else
    @include('includes.types.create.buttons')
@endif
</form>
</div>
