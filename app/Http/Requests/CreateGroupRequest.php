<?php

namespace App\Http\Requests;

use App\Models\Athlete;
use Pearl\RequestValidate\RequestAbstract;

class CreateGroupRequest extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'year_min' => 'required|integer|min:1990|max:2030|lt:year_max',
            'year_max' => 'required|integer|min:1990|max:2030|gt:year_min',
            'gender'   => 'required|in:' . implode(',', array_keys(Athlete::gender())),
            'is_odd'   => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
