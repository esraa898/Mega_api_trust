<?php

namespace App\Http\Requests;

use App\Http\traits\ApiResponceTrait;
use App\Models\task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;


class AddTaskRequest extends FormRequest
{
    use ApiResponceTrait;
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
        return task::rules();
    }

   
    
    public function failedValidation( $validator)
{
    $response= $this->apiResponce(404,'validation error',$validator->errors());
   
    throw (new ValidationException($validator, $response))->status(400);
}


    
}
