<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:stores', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string'],
            'store_name' => ['required', 'string', 'max:255'],
            'store_category_id' => ['required', 'exists:store_categories,id'],
            'subdomain' => ['required', 'string', 'unique:stores', 'max:255'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_name' => ucwords($this->first_name . ' ' . $this->last_name),
            'subdomain' => strtolower($this->subdomain),
        ]);
    }
}
