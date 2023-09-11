<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required | string | unique:technologies',
            'color' => 'required | string'
        ], [
            'label.required' => 'Choose a label for this technology',
            'label.unique' => 'A technology with this label already exists',
            'color.required' => 'Choose a color for this technology',
        ]);

        $data = $request->all();

        $technology = new Technology();

        $technology->fill($data);

        $technology->save();

        return to_route('admin.technologies.index')
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully created')
            ->with('alert-model', "$technology->label");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' => ['required', 'string', Rule::unique('technologies')->ignore($technology->id)],
            'color' => 'required | string'
        ], [
            'label.required' => 'Choose a label for this technology',
            'label.unique' => 'A technology with this label already exists',
            'color.required' => 'Choose a color for this technology',
        ]);

        $data = $request->all();

        $technology->update($data);

        return to_route('admin.technologies.index')
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully updated')
            ->with('alert-model', "$technology->label");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')
            ->with('alert-type', 'danger')
            ->with('alert-message', 'has been successfully deleted')
            ->with('alert-model', "$technology->label");
    }
}
