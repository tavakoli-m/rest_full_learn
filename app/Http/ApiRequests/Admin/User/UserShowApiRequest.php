<?php

namespace App\Http\ApiRequests\Admin\User;

use App\Base\ApiFormRequest\ApiFormRequest;
use Illuminate\Support\Facades\Gate;

class UserShowApiRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('read_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
