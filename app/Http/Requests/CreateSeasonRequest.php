<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class CreateSeasonRequest extends RequestAbstract
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
        $min = config('api.season_year_min');
        $max = config('api.season_year_max');

        return [
            'title'        => 'required|string|max:255',
            'year_min'     => 'required|integer|lt:year_max|min:' . $min . '|max:' . $max,
            'year_max'     => 'required|integer|gt:year_min|min:' . $min . '|max:' . $max,
            'is_odd_group' => 'required|boolean',
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
