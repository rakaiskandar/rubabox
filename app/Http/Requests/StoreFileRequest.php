<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_code' => 'required',
            'file_name' => 'required|unique:files',
            'subsi_code' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,doc,docx,xlsx,xls,pdf|max:10240',
            'section' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'file_name.unique' => 'File name already exist',
            'subsi_code.required' => 'Subsi code is required',
            'file.required.max.mimes' => 'File is required',
            'section.required' => 'Section is required'
        ];
    }
}
