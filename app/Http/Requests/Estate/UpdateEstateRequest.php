<?php

namespace App\Http\Requests\Estate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', "string", "min:5", "max:255"],
            'type' => ['required', "string"], //TODO: must be one of TypeEnum Cases
            'floor' => ['required', 'integer', "min:1", "max:40"],
            'meterage' => ['required', 'integer', "min:30", "max:1000"],
            'price' => ['required', 'integer', "min:50000000"],
            'mortgage_price' => ['nullable', 'integer', "min:50000000"],
            'rent_price' => ['nullable', 'integer', "min:100000"],
            'room_count' => ['required', 'integer', "min:0"],
            'toilet_count' => ['required', 'integer', "min:1"],
            'has_parking' => ['boolean'],
            'has_elevator' => ['boolean'],
            'has_warehouse' => ['boolean'],
        ];
    }
}
