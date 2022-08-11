<?php

    namespace App\Http\Requests;

    use Illuminate\Support\Str;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class CategoryFormRequest extends FormRequest
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
            if( ! $this->has('slug') || empty($this->slug)) {
                $slug = Str::slug($this->name);
                $this->merge(['slug' => $slug]);
            }
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'slug' => 'required',
                'name' => 'required|string',
                'category_id' => ['required', 'integer', Rule::notIn([$this->id])]
            ];
        }

        public function messages()
        {
            return [
                'name.required' => 'Category not created: the name field was left blank',
                'category_id.required' => 'Category not created: the name field was left blank',
            ];
        }
    }
