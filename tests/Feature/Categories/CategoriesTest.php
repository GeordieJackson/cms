<?php

    namespace Tests\Feature\Categories;

    use App\Http\Controllers\Backend\CategoriesController;
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\Artisan;
    use Tests\TestCase;
    use function array_diff;
    use function factory;

    class CategoriesTest extends TestCase
    {
        use RefreshDatabase;

        public function setUp(): void
        {
            parent::setUp();
            Artisan::call('db:seed --class=' . 'Database\\' . '\\Seeders\\' . '\\Tests\\' . '\\CategoriesTestSeeder');

            Post::factory()->count(3)->categorized()->create(['category_id' => 6]); // paranormal
            Post::factory()->count(5)->categorized()->create(['category_id' => 8]); // psychology
            Post::factory()->count(7)->categorized()->create(['category_id' => 10]); // fallacies
        }

        /**
         * @test
         */
        public function the_index_lists_all_categories()
        {
            $this->get('categories')
                ->assertViewIs('front.pages.categories.index')
                ->assertViewHas('categories');
        }

        /**
         * @test
         */
        public function posts_can_be_listed_by_their_category()
        {
            $response = $this->get('categories/paranormal');
            $this->assertEquals(3, $response->viewData('posts')->count());

            $response = $this->get('categories/psychology');
            $this->assertEquals(5, $response->viewData('posts')->count());

            $response = $this->get('categories/fallacies');
            $this->assertEquals(7, $response->viewData('posts')->count());

            $this->get('categories/this-category-does_not-exist')->assertNotFound();
        }
        
        /** @test  */
        function category_listing_includes_subcategories_when_present()
        {
            Post::factory()->categorized()->create(['category_id' => 15]);
            Post::factory()->categorized()->create(['category_id' => 16]);
            $this->get('categories/health')
                ->assertSee('acupuncture')
                ->assertSee('homeopathy')
                ->assertDontSee('chiropractic') // subcategory but empty
            ;
        }
        
        /** @test  */
        function a_404_is_returned_when_category_not_found()
        {
            $this->get('categories/this-category-does-not-exist')->assertNotFound();
        }

        /**
         * @test
         */
        public function a_categorys_descendents_can_be_returned()
        {
            $categories = Category::withChildIds()->get();
            $category = $categories[22];

            $this->assertEmpty(array_diff([6, 17, 18, 19, 20, 21, 22], $category->getIdList()->toArray()));
        }
        
        /** @test  */
        function when_a_category_is_deleted_its_direct_descendents_are_promoted_to_the_categorys_parent_id()
        {
            $id = 14; // Alt med
            $category = Category::whereId($id)->first();
            $categoryId = $category->category_id; // 4 = health
            (new CategoriesController())->destroy($category);
            $this->assertDatabaseMissing('categories', ['id' => $id]);
            
          //  Category::where('category_id', $id)->update(['category_id' => $categoryId]);
            
            $this->assertDatabaseHas('categories', ['id'=> 15, 'category_id' => $categoryId,  'slug' => 'acupuncture']);
            $this->assertDatabaseHas('categories', ['id'=> 16, 'category_id' => $categoryId,  'slug' => 'homeopathy']);
        }
    }
