<?php

namespace App\Http\Requests;

use App\Models\task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
        return  array_merge( task::rules(),[ 'id' => 'exists:tasks,id'] ) ;
    }

    public function failedValidation( $validator)
{
    $response= $this->apiResponce(404,'validation error',$validator->errors());
   
    throw (new ValidationException($validator, $response))->status(400);
}


    
}
