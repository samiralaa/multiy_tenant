<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'service' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'project_area' => 'required|string|max:255',
            'project_address' => 'required|string|max:255',
            'client_requirements' => 'required|string',
        ];
    }
}
