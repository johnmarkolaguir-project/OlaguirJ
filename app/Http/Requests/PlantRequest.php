<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255'],
            'room' => ['required', 'string', 'max:100'],
            'water_every_days' => ['required', 'integer', 'min:1', 'max:90'],
            'last_watered_at' => ['nullable', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'water_every_days' => 'watering interval',
            'last_watered_at' => 'last watered date',
        ];
    }
}
