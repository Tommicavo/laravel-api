@if ($technology->exists)
    {{-- Edit form --}}
    <h1 class="text-center py-4">Edit {{ $technology->title }} technology</h1>
    <div class="editContent">
        <form action=" {{ route('admin.technologies.update', $technology->id) }} " method="POST">
            @method('PUT')
        @else
            {{-- Create form --}}
            <h1 class="text-center py-4">Add a New Technology</h1>
            <div class="createContent">
                <form action=" {{ route('admin.technologies.store') }} " method="POST">
@endif

@csrf
{{-- label --}}
<div class="mb-3">
    <label for="technologyLabel" class="form-label">Label</label>
    <input type="text"
        class="form-control @error('label') is-invalid @elseif(old('label')) is-valid @enderror"
        id="technologyLabel" placeholder="Write label..." name="label"
        value=" {{ old('label', $technology->label) }} ">
    @error('label')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

{{-- color --}}
<div class="mb-3">
    <label for="technologyColor" class="form-label">Pick Color</label>
    <select class="form-select" aria-label="Default select example" id="technologyColor" name="color">
        @foreach (config('techColors') as $color)
            <option value="{{ $color['color'] }}" @if ($color['color'] === old('color', $technology->color)) selected @endif
                class="text-{{ $color['color'] }} fw-bold @error('color') is-invalid @elseif(old('color')) is-valid @enderror">
                {{ $color['color_name'] }}</option>
        @endforeach
    </select>
    @error('color')
        <div class="invalid-feedback"> {{ $message }} </div>
    @enderror
</div>

@if ($technology->exists)
    @include('includes.technologies.edit.buttons')
@else
    @include('includes.technologies.create.buttons')
@endif
</form>
</div>
