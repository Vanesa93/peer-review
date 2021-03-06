<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCoursesFormRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'language' => 'required|max:100',
             'duration' => 'max:100',
             'requirments' => 'max:100',
        ];
    }

}
