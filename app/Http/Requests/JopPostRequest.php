<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JopPostRequest extends FormRequest
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
            'title' => 'required|min:6',
            'description' => 'required|min:15',
            'roles' => 'required|min:10',
            'job_type' => 'required',
            'feature_photo' => 'mimes:png,jpg,jpeg|max:2048',
            'address' => 'required',
            'salary' => 'required',
            'application_close_date' => 'required',
        ];
    }
}
