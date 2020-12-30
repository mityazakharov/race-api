<?php

namespace App\Http\Requests;

use App\Models\Athlete;
use App\Models\Result;
use Pearl\RequestValidate\RequestAbstract;

class CreateResultRequest extends RequestAbstract
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
            'race_id'    => 'required|exists:races,id',
            'athlete_id' => 'required|exists:athletes,id',
            'team_id'    => 'required|exists:teams,id',
            'rate'       => 'in:' . implode(',', Athlete::rates()),
            'group_id'   => 'required|exists:groups,id',
            'bib'        => 'integer|min:1',
            'run_1'      => 'integer|min:1',
            'status_1'   => 'required_with:run_1|in:' . implode(',', Result::statuses()),
            'run_2'      => 'integer|min:1',
            'status_2'   => 'required_with:run_2|in:' . implode(',', Result::statuses()),
            'total'      => 'required_with:run_1,run_2|integer|min:1',
            'diff'       => 'required_with:total|integer|min:0',
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
