<?php

namespace App\Http\Requests\Api;

class FavoriteRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "building_id" => "required",
            "visitor_id" => "required",
        ];
    }
}
