<?php

namespace App\Http\Requests\Admin\User;

use App\RestFulApi\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required','string','min:1','max:255'],
            'last_name' => ['required','string','min:1','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','max:255']
        ];
    }
}
