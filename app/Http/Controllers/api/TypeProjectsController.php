<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;

class TypeProjectsController extends Controller
{
    public function index(string $id)
    {
        $type = Type::find($id);
        if (!$type) return response(null, 404);

        $projects = Project::where('type_id', $id)
            ->where('is_published', true)
            ->orderBy('updated_at', 'DESC')
            ->with('type', 'technologies')
            ->get();

        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }

        $data = compact('type', 'projects');

        return response()->json($data);
    }
}
