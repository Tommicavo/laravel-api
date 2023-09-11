@if (session('alert-message'))
    <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show mt-5" role="alert">
        @if (session('alert-model'))
            <span>"<strong> {{ session('alert-model') }} </strong>" </span>
        @endif
        <span> {{ session('alert-message') }} </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
