<?php

namespace App\Http\Requests\ValidationDomain;

use App\Http\Requests\AbstractFormRequest;

class ValidationDomainRequest extends AbstractFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "domain" => "required|url",
            "method" => "required|in:dns,http",
        ];
    }
}
