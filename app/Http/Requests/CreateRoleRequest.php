<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Gate;

    class CreateRoleRequest extends FormRequest
    {
        protected function prepareForValidation()
    {
        if( ! $this->has('description') || empty($this->description)) {
            $this->merge(['description' => '']);
        }
    }

        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'slug' => 'required|string|unique:roles,slug',
                'name' => 'required|string',
                'description' => 'present',
            ];
        }
    }
