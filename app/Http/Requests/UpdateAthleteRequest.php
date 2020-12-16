<?php

namespace App\Http\Requests;

use App\Models\Athlete;
use Pearl\RequestValidate\RequestAbstract;

class UpdateAthleteRequest extends RequestAbstract
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
            'first_name' => 'string|max:255',
            'last_name'  => 'string|max:255',
            'year'       => 'integer|min:' . $min . '|max:' . $max,
            'gender'     => 'in:' . implode(',', array_keys(Athlete::gender())),
            'team_id'    => 'exists:teams,id',
            'rate'       => 'in:' . implode(',', Athlete::rates()),
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
