<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'vehicle_type' => 'required',
            'model' => 'required',
            'brand' => 'nullable',
            'color' => 'nullable',
            'daily_price' => 'required|numeric',
        ];
    }
}
