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
        $min = config('api.birth_year_min');
        $max = config('api.birth_year_max');

        return [
            'title'    => 'required|string|max:255',
            'year_min' => 'required|integer|min:' . $min . '|max:' . $max . '|lt:year_max',
            'year_max' => 'required|integer|min:' . $min . '|max:' . $max . '|gt:year_min',
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
