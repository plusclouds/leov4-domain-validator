<?php

namespace App\Http\Requests;

use App\Http\Requests\AbstractFormRequest;

class DomainRequest extends AbstractFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * 
     * @return string[]
     */
    public function rules(): array
    {
        return [
            "domain" => "required|url"
        ];
    }
}
