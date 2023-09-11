<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $types = Type::all();

        $searchFilter = $request->query('searchFilter');
        $publishFilter = $request->query('publishFilter');
        $typeFilter = $request->query('typeFilter');

        $query = Project::orderBy('order');

        if ($publishFilter) {
            $value = $publishFilter === 'published' ? 1 : 0;
            $query->where('is_published', $value);
        }

        if ($searchFilter) {
            $query->where('title', 'LIKE', "%$searchFilter%");
        }

        if ($typeFilter) {
            $query->where('type_id', $typeFilter);
        }

        $projects = $query->where('user_id', Auth::id())->get();

        $data = compact('projects', 'searchFilter', 'publishFilter', 'typeFilter', 'types');

        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();

        $data = compact('project', 'types', 'technologies');

        return view('admin.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $total_projects = Project::count();
        $project = new Project();

        if (Arr::exists($data, 'image')) {
            $img_url = Storage::putFile('project_images', $data['image']);
            $data['image'] = $img_url;
        }

        $data['is_published'] = Arr::exists($data, 'is_published');

        $project->fill($data);

        $project->slug = Str::slug($project->title, '-');
        $project->order = $total_projects + 1;

        $project->save();

        if (Arr::exists($data, 'tecnologies')) $project->technologies()->attach($data['technologies']);

        return to_route('admin.projects.show', $project->id)
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully added')
            ->with('alert-model', "$project->title");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $prevProject = Project::where('id', '<', $id)->orderBy('id', 'DESC')->first();
        $nextProject = Project::where('id', '>', $id)->first();

        if (!$prevProject) {
            $prevProject = Project::orderBy('id', 'DESC')->first();
        }

        if (!$nextProject) {
            $nextProject = Project::orderBy('id')->first();
        }

        $data = compact('project', 'prevProject', 'nextProject');

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        if (Auth::id() !== $project->user_id) {
            return to_route('admin.projects.show', $project->id)
                ->with('alert-type', 'warning')
                ->with('alert-message', 'You are not the author of the project. You can not modify it!');
        }

        $types = Type::all();
        $technologies = Technology::all();
        $project_technology_ids = $project->technologies->pluck('id')->toArray();

        $data = compact('project', 'types', 'project_technology_ids', 'technologies');

        return view('admin.projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $data = $request->validated();

        $project = Project::findOrFail($id);

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_images', $data['image']);
            $data['image'] = $img_url;
        }

        $data['is_published'] = Arr::exists($data, 'is_published');

        $project->fill($data);

        $project->slug = Str::slug($project->title, '-');

        $project->save();

        if (!Arr::exists($data, 'technologies') && count($project->technologies)) $project->technologies()->detach();
        else if (Arr::exists($data, 'technologies')) $project->technologies()->sync($data['technologies']);

        return to_route('admin.projects.show', $project->id)
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully updated')
            ->with('alert-model', "$project->title");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return to_route('admin.projects.index')
            ->with('alert-type', 'danger')
            ->with('alert-message', 'has been successfully moved into Trash Can')
            ->with('alert-model', "$project->title");
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(string $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return to_route('admin.projects.trash')
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully restored')
            ->with('alert-model', "$project->title");
    }

    public function drop(string $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        if ($project->image) Storage::delete($project->image);

        if (count($project->technologies)) $project->technologies()->detach();

        $project->forceDelete();

        return to_route('admin.projects.trash')
            ->with('alert-type', 'danger')
            ->with('alert-message', 'has been successfully erased from Trash Can')
            ->with('alert-model', "$project->title");
    }

    public function dropAll()
    {
        $projectCount = Project::onlyTrashed()->count();
        $all_projects = Project::onlyTrashed()->get();
        $projects = Project::onlyTrashed();

        foreach ($all_projects as $project) {
            if ($project->image) Storage::delete($project->image);
            if (count($project->technologies)) $project->technologies()->detach();
        }

        $projects->forceDelete();

        return to_route('admin.projects.trash')
            ->with('alert-type', 'danger')
            ->with('alert-message', "$projectCount projects has been successfully erased from Trash Can");
    }

    public function reorder(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        if (!$project) return response(null, 404);

        $prev_order = $project->order;
        $new_order = $request->order;

        if ($prev_order != $new_order) {
            $project->order = $new_order;
            $project->save();

            $this->rearrangeOtherProjects($id, $prev_order, $new_order);

            return response("Project with id: $id moved from position: $prev_order to position: $new_order", 200);
        }
    }

    public function rearrangeOtherProjects($moved_row_id, $moved_row_prev_order, $moved_row_new_order)
    {
        $projects = Project::where('id', '<>', $moved_row_id)->get();

        foreach ($projects as $project) {
            if ($moved_row_new_order > $moved_row_prev_order) {
                if ($project->order > $moved_row_prev_order && $project->order <= $moved_row_new_order) {
                    $project->order--;
                    $project->save();
                }
            } else {
                if ($project->order < $moved_row_prev_order && $project->order >= $moved_row_new_order) {
                    $project->order++;
                    $project->save();
                }
            }
        }
    }

    public function toggle(string $id)
    {
        $project = Project::findOrFail($id);
        $project->is_published = !$project->is_published;

        $toggle_type = $project->is_published ? 'success' : 'info';
        $toggle_output = $project->is_published ? 'published' : 'saved as Draft';

        $project->save();

        return to_route('admin.projects.index')
            ->with('alert-type', $toggle_type)
            ->with('alert-message', "Post has been successfully $toggle_output")
            ->with('alert-model', "$project->title");
    }
}
