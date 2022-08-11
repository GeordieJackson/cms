<?php

    namespace Tests\Unit\Posts;

    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use Carbon\Carbon;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PostPublishedParametersTest extends TestCase
    {
        use RefreshDatabase;

        /*
        |--------------------------------------------------------------------------
        | Published test
        |--------------------------------------------------------------------------
        |
        | This test is to make sure that the 'all' option works in the Post Scopes file
        | the published method makes sure that only posts that are set to published
        | are returned - this also excludes posts that are published but their publish_at
        | date has not yet been reached.
        |
        | This may be useful for the backend - if not, remove the functionality
        */

        public function setUp() : void
        {
            parent::setUp();

            $categoryId = Category::factory()->create(['name' => 'category'])->id;

            // Published = 32, without published_at = 34
            Post::factory()->page()->create(['slug' => 'about-us']);
            Post::factory()->page()->create(['slug' => 'contact-us', 'published' => 0]);
            Post::factory()->categorized()->create(['slug' => 'cat-1']);
            Post::factory()->categorized()->create(['slug' => 'cat-2', 'published' => 0]);
            Post::factory()->categorized()->create([
                'slug' => 'cat-3',
                'publication_date' => Carbon::now()->addDay(),
            ]);
            Post::factory()->temporalBlog()->create(['slug' => 'bp-1']);
            Post::factory()->temporalBlog()->create(['slug' => 'bp-2', 'published' => 0]);
            Post::factory()->temporalBlog()->create([
                'slug' => 'bp-3',
                'publication_date' => Carbon::now()->addDay(),
            ]);

            Post::factory()->count(10)->categorized()->create(['published' => 0, 'category_id' => $categoryId]);
            Post::factory()->count(12)->categorized()->create(['category_id' => $categoryId]);
            Post::factory()->count(10)->temporalBlog()->create(['published' => 0]);
            Post::factory()->count(17)
                ->temporalBlog()
                ->create(); // Expected will be this + 1 because of the single published post above
        }

        /**
         * @test
         */
        public function only_fully_published_posts_are_returned()
        {
            $posts = Post::published()->get();
            $this->assertEquals(32, $posts->count());
        }
    }
