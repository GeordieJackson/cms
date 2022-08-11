<?php

    namespace Tests\Feature\Backend\Dashboard\posts;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use function factory;
    use function route;

    class PostValidationTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp() : void
        {
            parent::setUp();

            $this->signInAdminUser();
            $this->withExceptionHandling();
        }

        /**
         * @test
         *
         * @dataProvider PostFormData
         */
        public function post_form_validates_rules($key, $value)
        {
            $this->post(route('dashboard.posts.store'), [$key => $value])
                 ->assertStatus(302)
                 ->assertSessionHasErrors($key);
        }

        public function PostFormData()
        {
            return [
                'Owner_id is required' => ['owner_id', null],
                'Owner_id is an integer' => ['owner_id', null],
                'Category id is an integer when present' => ['category_id', 'text'],
                'Temporal id is an integer when present' => ['temporal_id', 'text'],
                'Slug is required' => ['slug', null],
            ];
        }

        /**
         * @test
         *
         * @dataProvider PresentFormFields
         */
        public function post_form_validates_present_rules($key, $value)
        {
            $this->post(route('dashboard.posts.store'), ['' => $value])
                 ->assertStatus(302)
                 ->assertSessionHasErrors($key);
        }

        public function PresentFormFields()
        {
            return [
                'meta_title is not present' => ['meta_title', null],
                'meta_description is not present' => ['meta_description', null],
                'meta_keywords is not present' => ['meta_keywords', null],
                'title is not present' => ['title', null],
                'subtitle is not present' => ['subtitle', null],
                'summary is not present' => ['summary', null],
                'body is not present' => ['body', 'text'],
                'pdf is not present' => ['pdf', null],
            ];
        }
    
        /**
         * @test
         *
         * @dataProvider PublishedFormFields
         */
        function form_validation_when_post_is_published($key, $value)
        {
            $this->post(route('dashboard.posts.store'), ['published' => 1, '' => $value])
                ->assertStatus(302)
                ->assertSessionHasErrors($key);
        }
    
    
    
        public function PublishedFormFields()
        {
            return [
                'Type is required when published' => ['type', null],
                'Publication date is required when published' => ['publication_date', null],
            ];
        }
        

        /**
         * @test
         *
         * @dataProvider temporalRequiredWhenFormFields
         */
        public function temporal_field_is_required_when_another_field_is_present($key, $value)
        {
            $formData = Post::factory()->temporal()->raw([$key => $value]);
            $this->post(route('dashboard.posts.store'), $formData)->assertSessionHasErrors('temporal_id');
        }

        public function temporalRequiredWhenFormFields()
        {
            return [
                'The temporal_id is not present but the type is temporal' => ['temporal_id', null],
            ];
        }
    
        /**
         * @test
         *
         * @dataProvider categorizedRequiredWhenFormFields
         */
        public function categorized_field_is_required_when_another_field_is_present($key, $value)
        {
            $formData = Post::factory()->categorized()->raw([$key => $value]);
            $this->post(route('dashboard.posts.store'), $formData)->assertSessionHasErrors('category_id');
        }
    
        public function categorizedRequiredWhenFormFields()
        {
            return [
                'The category_id is not present but the type is categorized' => ['category_id', null],
            ];
        }
    }
