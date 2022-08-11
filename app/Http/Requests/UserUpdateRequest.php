<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected function prepareForValidation()
    {
            $slug = Str::slug($this->forename . "-" . $this->surname);
            $this->merge(['slug' => $slug]);
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'forename' => 'required|string',
            'surname' => 'required|string',
            'slug' => 'required|string',
            'email' => 'required|email',
            'roles' => 'required|int'
        ];
    }
}
