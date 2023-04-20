<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: implement request authorization
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'uid' => ['required', 'numeric', 'max_digits:13'],
            'title' => ['required'],
            'quantity' => ['required', 'integer', 'min:1', 'max: 4294967295'],
            'buy_price' => ['required', 'integer', 'min:1', 'max: 4294967295'],
            'sell_price' => ['required', 'integer', 'min:1', 'max: 4294967295'],
        ];
    }
}
