<?php
    
    namespace App\Http\Requests;
    
    use App\Models\Posts\Post;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
    
    use function request;
    
    class PostRequest extends FormRequest
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
            /**
             *  Stop previously set parameters from being carried over
             *
             * @NOTE: This is probably not the best location for this
             */
            if ($this->type == 1) {
                $this->merge(['category_id' => null]);
            } elseif ($this->type == 2) {
                $this->merge(['temporal_id' => null]);
            } elseif ($this->type == 3) {
                $this->merge(['category_id' => null, 'temporal_id' => null]);
            }
            
            $this->merge(['published' => $this->has('published') ? 1 : 0]);
            $this->merge(['sticky' => $this->has('sticky') ? 1 : 0]);
        }
        
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            //          dd($this->get('published'));
            return [
                'owner_id' => ['required', 'integer'],
                'type' => [
                    'required_if:published,1',
                    'integer',
                    'nullable',
                ],
                'category_id' => [
                    Rule::requiredIf($this->type == Post::CATEGORIZED && $this->published == 1),
                    'integer',
                    'nullable',
                ],
                'temporal_id' => [
                    Rule::requiredIf($this->type == Post::TEMPORAL && $this->published == 1),
                    'integer',
                    'nullable',
                ],
                'slug' => [
                    'required',
                    Rule::unique('posts', 'slug')
                        ->ignore((request()->method == "PATCH" || request()->method == "PUT") ? request()->input('slug') : null,
                            'slug') // Distinguish between create/store and updates
                ],
                'meta_title' => ['present', 'nullable'],
                'meta_description' => ['present', 'nullable'],
                'meta_keywords' => ['present', 'nullable'],
                'title' => ['present', 'nullable'],
                'subtitle' => ['present', 'nullable', 'max:750'],
                'summary' => ['present', 'nullable'],
                'body' => ['present', 'nullable'],
                'pdf' => ['present', 'nullable'],
                'published' => ['present', 'nullable'],
                'sticky' => ['required'],
                'image' => ['present', 'nullable'],
                'publication_date' => [
                    'required_if:published,1',
                    'date',
                    'nullable',
                ],
            ];
        }
        
        public function messages()
        {
            return [
                'slug.unique' => 'ERROR: a post with that slug already exists',
                'category_id.required' => "Select Category field is required -  or unpublish to save",
                'temporal_id.required' => "Select temporal name field is required -  or unpublish to save",
                'type.required_if' => 'The type is required when published is set',
                'publication_date.required_if' => 'The publication date is required when published is set',
            ];
        }
    }
