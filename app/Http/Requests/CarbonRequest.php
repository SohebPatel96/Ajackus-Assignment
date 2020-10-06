<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarbonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'activityType' => 'required|in:' . constants('ACTIVITY_TYPE.MILE'),
            'activity' => 'required|integer|between:1,10000',
            'country' => 'required|in:' . constants('COUNTRY.USA') . ',' . constants('COUNTRY.UK'),
            'mode' => 'required|in:' . constants('MODE.DIESEL_CAR') . ',' . constants('MODE.PETROL_CAR')
                . ',' . constants('MODE.TAXI') . ',' . constants('MODE.BUS') . ',' . constants('MODE.TRANSIT_RAIL'),
        ];
    }
}
