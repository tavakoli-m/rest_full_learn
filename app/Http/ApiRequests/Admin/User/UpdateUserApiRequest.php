<?php

namespace App\Http\ApiRequests\Admin\User;

use App\Models\User;
use App\RestFulApi\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateUserApiRequest extends ApiFormRequest
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
        return User::rules([
            'email' => ['required','email','max:255',Rule::unique('users','email')->ignore($this->user->id)],
            'password' => ['nullable','string','min:8','max:255']
        ]);
    }
}
