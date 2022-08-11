<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Str;

    class TemporalNameRequest extends FormRequest
    {
        protected function prepareForValidation()
        {
            $slug = Str::slug($this->slug);
            $this->merge(['slug' => $slug]);
        }
    
        public function rules()
        {
            return [
                'name' => 'required|string',
                'slug' => 'required|string',
                'active' => 'required|bool'
            ];
        }
        
        public function authorize()
        {
            return true;
        }
    }