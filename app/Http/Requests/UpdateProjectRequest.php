<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> ['required', 'string', 'max:100', 'min:3'], Rule::unique('posts')->ignore($this->project),
            'image' =>['nullable', 'image'],
            'language'=>['required', 'string', 'max:50'],
            'url' =>['nullable', 'url','max:2048']
        ];
    }

    public function messages(){

        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least :min characters.',
            'name.max' => 'The name may not be greater than :max characters.',
            'language.required' => 'The language field is required.',
            'language.max' => 'The language may not be greater than :max characters.',
            'image.max' => 'The image may not be greater than :max characters.',
            'url.max' => 'The url may not be greater than :max characters.',
        ];
    }
}
