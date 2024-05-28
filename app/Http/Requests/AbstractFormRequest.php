<?php
namespace App\Http\Requests;

use App\Common\Enums\ErrorCodes;
use \Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class AbstractFormRequest extends FormRequest
{

    /**
     * This function overrides failedValidation method inside FormRequest class which is called when validation fails.
     * Purpose of this override is to customize the response when validation fails.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator){
        $errors = $validator->errors();

        $data = [
            'message' => 'The given data was invalid.',
            'code' => ErrorCodes::VALIDATION_ERROR,
            'errors' => $errors
        ];

        throw new HttpResponseException(response()->json($data, 422));
    }

}
