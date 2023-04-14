<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'locale' => $this->user ? $this->user()->locale : 'en_GB',
    //     ]);

    //     $tax_percentage = match ($this->locale) {
    //         'en_GB' => 17.5,
    //         'en_US' => 10.0,
    //         'de_DE' => 12.5,
    //         default => 5.0
    //     };

    //     $this->merge([
    //         'tax_percentage' => $tax_percentage
    //     ]);
    // }

    public function rules(): array
    {
        return match($this->method()) {
            'POST' => [
                'name' => ['required', 'string', 'max:50', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
            ],
            'PUT', 'PATCH' => [
                'name' => ['required', 'string', 'max:50', 'unique:users,name,'.$this->route('user')],
                'email' => ['required', 'email', 'unique:users,email,'.$this->route('user')],
            ]
        };
    }

    // protected function passedValidation(): void
    // {
    //     $this->merge([
    //         'password' => bcrypt('12345678'),
    //     ]);
    // }

}
