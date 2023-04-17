<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'uid' => [
                'required', 'numeric', 'max_digits:13',
                Rule::unique('products')->where(function ($query) {
                    return $query->where('uid', $this->uid)
                        ->where('price', $this->price);
                })
            ],
            'title' => ['required'],
            'quantity' => ['required', 'integer', 'min:1', 'max: 4294967295'],
            'price' => ['required', 'integer', 'min:1', 'max: 4294967295']
        ];
    }

    /**
     * Custom messages
     */
    public function messages()
    {
        return [
            'uid.unique' => 'The combination of uid and price has already been taken.'
        ];
    }
}
