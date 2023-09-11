<table class="table mb-4">
    <thead>
        @if ($projects->isNotEmpty())
            <tr>
                <th scope="col" colspan="1">#</th>
                <th scope="col" colspan="1">Title</th>
                <th class="text-center" scope="col" colspan="1">Type</th>
                <th class="text-center" scope="col" colspan="1">Technologies</th>
                <th scope="col" colspan="1">Status</th>
                <th scope="col" colspan="1">Author</th>
                <th class="text-center" scope="col" colspan="1">Tasks</th>
            </tr>
        @endif
    </thead>
    <tbody>
        @forelse($projects as $project)
            <tr draggable="true" class="draggable" data-id="{{ $project->id }}" data-position="{{ $loop->iteration }}">
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>
                    <div class="type d-flex justify-content-center align-items-center">
                        @if ($project->type)
                            <div class="badge p-2" style="background-color: {{ $project->type->color }}">
                                {{ $project->type->label }}
                            </div>
                        @else
                            <div class="badge p-2 d-flex gap-2" style="background-color: black">
                                <span><i class="fa-solid fa-triangle-exclamation text-warning"></i></span>
                                <span>Not assigned yet</span>
                                <span><i class="fa-solid fa-triangle-exclamation text-warning"></i></span>
                            </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="technologies">
                        @forelse ($project->technologies as $technology)
                            <div class="techColor badge rounded-pill text-bg-{{ $technology->color }}">
                                {{ $technology->label }}</div>
                        @empty
                            <div class="techColor badge rounded-pill text-bg-dark">
                                <span><i class="fa-solid fa-triangle-exclamation text-warning"></i></span>
                                <span>No Technology assigned yet</span>
                            </div>
                        @endforelse
                    </div>
                </td>
                <td>
                    @if (Auth::id() === $project->user_id)
                        <form method="POST" action="{{ route('admin.projects.toggle', $project->id) }}"
                            class="toggleForm" role="button">
                            @csrf
                            @method('PATCH')
                            <div class="form-check form-switch">
                                <label class="form-label">{{ $project->is_published ? 'Publish' : 'Draft' }}</label>
                                <input class="form-check-input publishCheck" type="checkbox" role="switch"
                                    id="is_published" name="is_published" value="1"
                                    @if (old('is_published', $project->is_published)) checked @endif>
                            </div>
                        </form>
                    @else
                        <div>{{ $project->is_published ? 'Published' : 'Drafted' }}</div>
                    @endif
                </td>
                <td>{{ $project->author ? $project->author->name : 'Anonimus' }}</td>
                <td>
                    @include('includes.projects.index.buttons')
                </td>
            </tr>
        @empty
            @include('includes.projects.index.emptyResults')
        @endforelse
    </tbody>
</table>
