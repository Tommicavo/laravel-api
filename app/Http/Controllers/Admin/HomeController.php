<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.home', compact('projects'));
    }
}
