<?php
    
    namespace Tests\Feature\AllPosts;
    
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use Facades\Tests\Setup\Pagination;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class PublishedTest extends TestCase
    {
        use RefreshDatabase;
        
        public function setUp(): void
        {
            parent::setUp();
            $this->withExceptionHandling();
            Pagination::off();
            
            $categoryId = Category::factory()->create(['slug' => 'category'])->id;
            
            Post::factory()->page()->create(['slug' => 'about-us']);
            Post::factory()->page()->create(['slug' => 'contact-us', 'published' => 0]);
            Post::factory()->categorized()->create(['slug' => 'cat-1']);
            Post::factory()->categorized()->create(['slug' => 'cat-2', 'published' => 0]);
            Post::factory()->temporalBlog()->create(['slug' => 'bp-1']);
            Post::factory()->temporalBlog()->create(['slug' => 'bp-2', 'published' => 0]);
            
            Post::factory()->count(10)->categorized()->create(['published' => 0, 'category_id' => $categoryId]);
            Post::factory()->count(12)->categorized()->create(['category_id' => $categoryId]);
            Post::factory()->count(10)->temporalBlog()->create(['published' => 0]);
            Post::factory()->count(17)->temporalBlog()->create(); // Expected will be this + 1 because of the single published post above
        }
        
        /**
         * @test
         */
        public function static_frontend_posts_must_be_published_to_be_displayed()
        {
            $response = $this->get('about-us');
            $response->assertViewHas('post');
            $response = $this->get('contact-us');
            $this->assertEquals(404, $response->getStatusCode());
        }
        
        /**
         * @test
         */
        public function temporal_frontend_posts_must_be_published_to_be_displayed()
        {
            $response = $this->get('blog/bp-1');
            $response->assertViewHas('post');
            $response = $this->get('blog/bp-2');
            $this->assertEquals(404, $response->getStatusCode());
        }
        
        /**
         * @test
         */
        public function all_posts_in_a_category_list_must_be_published()
        {
            $this->withoutExceptionHandling();
            $response = $this->get('categories/category');
            $this->assertEquals(12, $response->viewData('posts')->count());
        }
        
        /**
         * @test
         */
        public function all_posts_in_a_temporal_list_must_be_published() // i.e a blog/latest news/etc. home page
        {
            $response = $this->get('blog');
            $this->assertEquals(18, $response->viewData('posts')->count());
        }
    }
