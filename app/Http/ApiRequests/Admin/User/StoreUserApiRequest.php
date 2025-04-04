<?php

namespace App\Http\ApiRequests\Admin\User;

use App\Models\User;
use App\RestFulApi\ApiFormRequest;

class StoreUserApiRequest extends ApiFormRequest
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
        return User::rules();
    }
}
