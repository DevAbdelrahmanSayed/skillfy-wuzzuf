<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingJopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:6',
            'description' => 'required|min:15',
            'roles' => 'required|min:10',
            'job_type' => 'required',
            'feature_photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'address' => 'required',
            'salary' => 'required',
            'application_close_date' => 'required',
        ];
    }
}
