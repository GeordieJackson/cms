<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class CreatePermissionRequest extends FormRequest
    {
        protected function prepareForValidation()
        {
            if ( ! $this->has('description') || empty($this->description)) {
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
                'name' => 'required|string',
                'description' => 'present',
            ];
        }
    }
