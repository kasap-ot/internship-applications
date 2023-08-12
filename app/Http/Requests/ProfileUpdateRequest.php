<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Student;
use App\Models\Company;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        $role = $this->user()->userable_type;

        if ($role === Student::class) {
            $rules['gpa'] = 'required|decimal:2';
            $rules['university'] = 'required|string|max:100';
            $rules['major'] = 'required|string|max:100';
            $rules['dateEnrolled'] = 'required|date';
            $rules['credits'] = 'required|integer';
        } 
        elseif ($role === Company::class) {
            $rules['numEmployees'] = 'required|integer';
            $rules['field'] = 'required|string|max:100';
            $rules['foundingYear'] = 'required|integer|min:1';
            $rules['description'] = 'required|string|max:255';
            $rules['website'] = 'required|string|max:100';
            $rules['address'] = 'required|string|max:100';
            $rules['logoImage'] = 'image|max:1999|nullable';
        }

        return $rules;
    }
}
