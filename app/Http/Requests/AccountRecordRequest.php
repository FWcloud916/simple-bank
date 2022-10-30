<?php

namespace App\Http\Requests;

use App\Enums\AccountRecordType;
use App\Traits\ApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class AccountRecordRequest extends FormRequest
{
    use ApiTrait;

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
            'amount' => 'required|numeric|min:0',
            'type' => ['required', new Enum(AccountRecordType::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be numeric',
            'amount.min' => 'Amount must be greater than 0',
            'type.required' => 'Type is required',
            'type.Illuminate\Validation\Rules\Enum' => 'Type must be deposit or withdraw',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->return422Response((string) $validator->messages()->first()));
    }
}
