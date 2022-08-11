<?php

    namespace Tests\Feature\Backend\Dashboard\posts;

    use Tests\TestCase;
    use App\Models\Posts\Post;
    use App\Models\Categories\Category;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function factory;
    use function random_int;

    class PostCategoryCountsTest extends TestCase
    {
        use RefreshDatabase;

        protected $categoryCount;

        protected function setUp() : void
        {
            parent::setUp();
            Artisan::call('db:seed --class=' . 'Database\\' . '\\Seeders\\' . '\\Tests\\' . '\\CategoriesTestSeeder');
            $this->categoryCount = Category::count();
        }

        protected function addBackgroundData()
        {
            // Add some background interference
            Post::factory()->count(5)->temporal()->create();
            Post::factory()->create(['type' => Post::CATEGORIZED,
                'category_id' => random_int(1, $this->categoryCount)]);
        }

        /**
         * @test
         */
        public function the_categories_counts_are_present_and_all_zero_to_begin_with()
        {
            $this->assertGreaterThan(0, Category::count());
            $this->assertEquals(0, $this->getPostsCount());
        }

        /**
         * @test
         */
        public function creating_a_categorized_post_increases_the_post_count_by_1()
        {
            $this->addBackgroundData();
            $postCount = $this->getPostsCount();
            Post::factory()
                ->create(['type' => Post::CATEGORIZED, 'category_id' => random_int(1, $this->categoryCount)]);
            $this->assertEquals($postCount + 1, Category::get()->sum('count'));
        }

        /**
        * @test
        */
        public function updating_a_post_leaves_the_post_count_the_same()
        {
            $this->addBackgroundData();
            $postCount = $this->getPostsCount();
            $post = Post::where('type', Post::CATEGORIZED)->first();
            $post->update(['title' => 'This has been updated']);
            $this->assertDatabaseHas('posts', ['title' => 'This has been updated']);
            $this->assertEquals($postCount, Category::get()->sum('count'));
        }

        /**
        * @test
        */
        public function changing_the_post_type_decreases_the_post_count_by_1()
        {
            $this->addBackgroundData();
            $postCount = $this->getPostsCount();
            $post = Post::where('type', Post::CATEGORIZED)->first();
            $post->update(['title' => 'This has been updated', 'type' => Post::PAGE]);
            $this->assertDatabaseHas('posts', ['title' => 'This has been updated']);
            $this->assertEquals($postCount - 1, Category::get()->sum('count'));
        }

        /**
        * @test
        */
        public function deleting_a_post_decreases_the_post_count_by_1() {
            $this->addBackgroundData();
            $postCount = $this->getPostsCount();
            $post = Post::where('type', Post::CATEGORIZED)->first();
            $post->delete();
            $this->assertEquals($postCount - 1, Category::get()->sum('count'));
        }

        /**
         * @return mixed
         */
        protected function getPostsCount()
        {
            return Category::get()->sum('count');
        }
    }
