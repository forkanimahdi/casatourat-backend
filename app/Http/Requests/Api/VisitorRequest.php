<?php

namespace App\Http\Requests\Api;

class VisitorRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "full_name" => "required",
            "email" => "required",
            "token" => "required",
            "gender" => "required|in:male,female",
        ];
    }
}
