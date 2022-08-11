<?php

    namespace Tests\Feature\Menus;

    use App\Models\Posts\Post;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\DB;
    use Tests\TestCase;
    use App\Services\MenuBuilder;
    use App\Models\Categories\Category;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    use function factory;

    class DynamicMenuTest extends TestCase
    {
        use RefreshDatabase;

        protected $menuBuilder;

        public function setUp() : void
        {
            parent::setUp();
            
            Artisan::call('db:seed --class=' . 'Database\\' . '\\Seeders\\' . '\\Tests\\' . '\\CategoriesTestSeeder');

            $this->menuBuilder = new MenuBuilder();
        }

        /**
         * @test
         */
        public function no_categorized_articles_returns_an_empty_menu()
        {
            $this->menuBuilder->resetMenuTree(); // It's a static so needs clearing
            $menu = $this->menuBuilder->htmlMenu();
            $this->assertEmpty($menu);
        }

        /**
         * @test
         */
        public function top_level_categories_display_when_their_count_is_above_zero()
        {
            Category::whereSlug( 'critical-thinking')->update(['count' => 1]); // critical thinking
            Category::whereSlug( 'paranormal')->update(['count' => 1]); // critical thinking
            Category::whereSlug( 'psychology')->update(['count' => 1]); // critical thinking
            $menu = $this->menuBuilder->htmlMenu();
            $this->assertStringContainsString('critical-thinking', $menu);
            $this->assertStringContainsString('paranormal', $menu);
            $this->assertStringContainsString('psychology', $menu);
        }

        /**
         * @test
         */
        public function second_level_categories_display_when_their_count_is_above_zero_including_its_parent()
        {
            $post1 = Category::factory()->create(['id' => 100, 'count' => 0]);
            $post2 = Category::factory()->create(['id' => 200, 'category_id' => 100, 'count' => 1]);
            $post3 = Category::factory()->create(['id' => 300, 'count' => 1]);
            $post4 = Category::factory()->create(['id' => 400, 'category_id' => 300, 'count' => 1]);
            $menu = $this->menuBuilder->htmlMenu();
            $this->assertStringContainsString($post1->displayName, $menu);
            $this->assertStringContainsString($post2->displayName, $menu);
            $this->assertStringContainsString($post3->displayName, $menu);
            $this->assertStringContainsString($post4->displayName, $menu);
        }

        /**
         * @test
         */
        public function third_level_categories_display_when_their_count_is_above_zero_including_its_parents()
        {
            $post1 = Category::factory()->create(['id' => 1000, 'count' => 0]);
            $post2 = Category::factory()->create(['id' => 2000, 'category_id' => 1000, 'count' => 0]);
            $post3 = Category::factory()->create(['id' => 3000, 'category_id' => 2000, 'count' => 1]);
            $menu = $this->menuBuilder->htmlMenu();
            $this->assertStringContainsString($post1->displayName, $menu);
            $this->assertStringContainsString($post2->displayName, $menu);
            $this->assertStringContainsString($post3->displayName, $menu);
        }
        
        /** @test  */
        function a_subcat_menu_can_be_created_from_a_slug_string()
        {
          //  Post::factory()->categorized()->create(['category_id' => 15]);
            Post::factory()->categorized()->create(['category_id' => 16]);
            $string = 'health';
            $menu = $this->menuBuilder->htmlMenu($string);
            $this->assertIsString($menu);
            $this->assertNotEmpty($menu);
            $this->menuBuilder->resetMenuTree();
        }
        
        /** @test  */
        function a_subcat_menu_can_be_created_from_a_category()
        {
            Post::factory()->categorized()->create(['category_id' => 15]);
      //      Post::factory()->categorized()->create(['category_id' => 16]);
            $category = Category::whereSlug('health')->first();
            
            $menu = $this->menuBuilder->htmlMenu($category);
            $this->assertIsString($menu);
            $this->assertNotEmpty($menu);
            $this->menuBuilder->resetMenuTree();
        }
    }
