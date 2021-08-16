<?php

namespace App\Http\Requests\Auth\Role;

use App\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeRequest extends FormRequest
{
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
            'next_role' => ['required', Rule::in($this->roleKeys())],
        ];
    }

    private function roleKeys(): array
    {
        return Roles::getLowerKeys();
    }

    public function getNextRoleKey(): string
    {
        return $this->input('next_role');
    }
}
