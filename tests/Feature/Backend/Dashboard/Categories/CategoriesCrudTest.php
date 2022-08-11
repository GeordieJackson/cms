<?php

    namespace Tests\Feature\Backend\Dashboard\Categories;

    use Tests\TestCase;
    use App\Models\Categories\Category;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function route;
    use function factory;

    class CategoriesCrudTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp() : void
        {
            parent::setUp();

            $this->signInAdminUser(); // Only admins can deal with categories
        }

        /**
         * @test
         */
        public function a_category_is_created_from_valid_input()
        {
            $this->post(route('dashboard.categories.store'),
                ['slug' => 'alt-med', 'name' => 'Alternative Medicine', 'category_id' => 0])
                ->assertRedirect(route('dashboard.categories.index'))
            ;
            $this->assertDatabaseHas('categories', ['slug' => 'alt-med']);
        }

        /**
         * @test
         */
        public function a_category_is_created_from_input_with_no_slug_by_slugifying_the_name_field()
        {
            $this->post(route('dashboard.categories.store'),
                ['name' => 'Alternative Medicine', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $this->assertDatabaseHas('categories', ['slug' => 'alternative-medicine']);
        }

        /**
         * @test
         */
        public function an_error_is_displayed_when_theres_no_name_field()
        {
            $this->post(route('dashboard.categories.store'), ['category_id' => 0])->assertSessionHasErrors('name');
        }

        /**
         * @test
         */
        public function an_error_is_displayed_when_theres_no_category_id_field()
        {
            $this->post(route('dashboard.categories.store'),
                ['name' => 'Alternative Medicine'])->assertSessionHasErrors('category_id')
            ;
        }

        /**
         * @test
         */
        public function a_category_is_updated_from_valid_input()
        {
            $this->post(route('dashboard.categories.store'),
                ['slug' => 'alt-med', 'name' => 'Alternative Medicine', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $post = Category::whereSlug('alt-med')->first();
            $this->patch(route('dashboard.categories.update', $post->id),
                ['slug' => 'changed', 'name' => 'Changed', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $this->assertDatabaseHas('categories', ['slug' => 'changed']);
        }

        /**
         * @test
         */
        public function a_category_is_updated_from_input_with_no_slug_by_slugifying_the_name_field()
        {
            $this->post(route('dashboard.categories.store'),
                ['slug' => 'alt-med', 'name' => 'Alternative Medicine', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $post = Category::whereSlug('alt-med')->first();
            $this->patch(route('dashboard.categories.update', $post->id),
                ['slug' => null, 'name' => 'Changed', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $this->assertDatabaseHas('categories', ['slug' => 'changed']);
        }

        /**
         * @test
         */
        public function an_error_is_displayed_when_theres_no_name_field_in_the_update()
        {
            $this->post(route('dashboard.categories.store'),
                ['slug' => 'alt-med', 'name' => 'Alternative Medicine', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $post = Category::whereSlug('alt-med')->first();
            $this->patch(route('dashboard.categories.update', $post->id),
                ['slug' => 'changed', 'name' => null, 'category_id' => 0])->assertSessionHasErrors('name')
            ;
        }

        /**
         * @test
         */
        public function an_error_is_displayed_when_theres_no_category_id_field_in_the_update()
        {
            $this->post(route('dashboard.categories.store'),
                ['slug' => 'alt-med', 'name' => 'Alternative Medicine', 'category_id' => 0])->assertRedirect(route('dashboard.categories.index'))
            ;
            $post = Category::whereSlug('alt-med')->first();
            $this->patch(route('dashboard.categories.update', $post->id),
                ['slug' => 'changed', 'name' => 'Alternative medicine', 'category_id' => null])->assertSessionHasErrors('category_id')
            ;
        }

        /**
        * @test
        */
        public function a_category_can_be_deleted_if_its_count_is_zero()
        {
            $this->withoutExceptionHandling();
            $category = Category::factory()->create();
            $this->delete(route('dashboard.categories.destroy', $category->id));
            $this->assertDatabaseMissing('categories', ['slug' => $category->slug]);
        }
    }
