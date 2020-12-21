<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class UpdateRaceRequest extends RequestAbstract
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
            'title'         => 'string|max:255',
            'date_at'       => 'date_format:Y-m-d',
            'season_id'     => 'exists:seasons,id',
            'stage'         => 'integer|min:1',
            'discipline_id' => 'exists:disciplines,id',
            'is_final'      => 'boolean',
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
