<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = new Type();
        return view('admin.types.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required | string | unique:categories',
            'color' => 'required | regex:/^[0-9A-Fa]+$/'
        ], [
            'label.required' => 'Choose a label for this type',
            'label.unique' => 'A type with this label already exists',
            'color.required' => 'Choose a color for this type',
            'color.regex' => 'Invalid color value'
        ]);

        $data = $request->all();

        $type = new Type();

        $type->fill($data);

        $type->save();

        return to_route('admin.types.index')
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully created')
            ->with('alert-model', "$type->label");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'label' => ['required', 'string', Rule::unique('types')->ignore($type->id)],
            'color' => 'required | regex:/^[0-9A-Fa]+$/'
        ], [
            'label.required' => 'Choose a label for this type',
            'label.unique' => 'A type with this label already exists',
            'color.required' => 'Choose a color for this type',
            'color.regex' => 'Invalid color value'
        ]);

        $data = $request->all();

        $type->update($data);

        return to_route('admin.types.index')
            ->with('alert-type', 'success')
            ->with('alert-message', 'has been successfully updated')
            ->with('alert-model', "$type->label");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')
            ->with('alert-type', 'danger')
            ->with('alert-message', 'has been successfully deleted')
            ->with('alert-model', "$type->label");
    }
}
