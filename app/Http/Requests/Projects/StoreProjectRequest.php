<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required | string | unique:projects',
            'image' => 'nullable | image:jpg,jpeg,png',
            'description' => 'required | string',
            'is_published' => 'nullable | boolean',
            'type_id' => 'integer | exists:types,id',
            'technologies' => 'nullable | exists:technologies,id'
        ];
    }

    public function messages(): array
    {

        $data = $this->all();

        return [
            'title.required' => '"Title" field is required',
            'title.unique' => "'{$data['title']}' already exists",
            'description.required' => '"Description" field is required',
            'image.image' => 'You can upload .jpg, .jpeg, .png files',
            'is_published.boolean' => 'Invalid value for Status field',
            'type_id.exists' => 'Select a valid type to create this project',
            'type_id.integer' => 'Select a type label to create this project',
            'technologies.exists' => 'Invalid technology, choose from those given'
        ];
    }
}
