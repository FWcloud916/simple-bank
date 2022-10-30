<?php

namespace App\Http\Requests;

use App\Traits\ApiTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiRequest extends FormRequest
{
    use ApiTrait;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->return422Response((string) $validator->messages()->first()));
    }
}
