<?php

namespace App\Http\Requests\Auto;

use App\Models\Auto;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'start' => 'required|string|date_format:Y-m-d H:i:s',
            'end' => 'required|string|date_format:Y-m-d H:i:s',
            'classes' => 'array|nullable',
            'classes.*' => 'integer|required|in:'.Auto::getClasses(),
            'brand' => 'nullable|string',
        ];
    }
}
