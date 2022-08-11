<?php
    
    namespace Tests\Feature\TemporalPages;
    
    use App\Models\Posts\Post;
    use App\Models\TemporalNames\TemporalName;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    use function now;

    class TemporalPagesTest extends TestCase
    {
        use RefreshDatabase;
        
        /**
         * @test
         */
        public function the_index_fetches_a_list_of_temporal_post_data_only()
        {
            Post::factory()->count(3)->page()->create();
            Post::factory()->count(4)->temporalBlog()->create();
            Post::factory()->count(4)->temporalLatestNews()->create();
            Post::factory()->count(5)->categorized()->create();
            $response = $this->get('blog');
            $response->assertViewIs('front.pages.temporal.index');
            $response->assertViewHas('posts');
            $this->assertEquals(4, $response->viewData('posts')->count());
        }
        
        /**
         * @test
         */
        public function the_index_list_displays_stickied_posts_first()
        {
            $stickyTitle = "This is a sticky post";
            Post::factory()->count(4)->temporalBlog()->create();
            Post::factory()->temporalBlog()->create(['sticky' => 1, 'title' => $stickyTitle]);
            Post::factory()->count(4)->temporalBlog()->create();
            $response = $this->get('blog');
            $firstPost = $response->viewData('posts')->first();
            $this->assertEquals($stickyTitle, $firstPost->title);
        }
        
        /**
         * @test
         */
        public function it_matches_and_returns_a_temporal_article()
        {
            Post::factory()->temporalBlog()->create(['slug' => 'this-is-a-blog-article']);
            $this->assertDatabaseHas('posts', ['slug' => 'this-is-a-blog-article']);
            $response = $this->get('blog/this-is-a-blog-article');
            $response->assertViewIs('front.pages.temporal.show');
            $this->assertEquals(1, $response->viewData('post')->count());
            $this->assertEquals(Post::TEMPORAL, $response->viewData('post')->type);
        }
        
        /**
         * @test
         */
        public function a_temporal_article_can_only_be_displayed_in_its_own_temporal_name()
        {
            Post::factory()->temporalBlog()->create(['slug' => 'this-is-a-blog-article']);
            $response = $this->get('latest-news/this-is-a-blog-article'); // <- latest-news instead of blog is what we're testing here
            $this->assertEquals(404, $response->getStatusCode());
        }
        
        /**
         * @test
         */
        public function it_throws_a_ModelNotFoundException_when_temporal_article_not_matched()
        {
            $this->withoutExceptionHandling();
            $this->expectException(ModelNotFoundException::class);
            Post::factory()->temporalBlog()->create(['slug' => 'this-is-an-article']);
            $this->get('blog/this-article-does-not-exist');
        }
        
        /**
         * @test
         */
        public function it_returns_a_404_for_an_empty_temporal_category()
        {
            TemporalName::factory()->blog()->create();
            $this->assertDatabaseHas('temporal_names', ['name' => 'blog']);
            $this->get('blog')->assertNotFound();
        }
    
        /**
         * @test
         */
        public function it_returns_a_404_for_an_empty_temporal_category_with_a_pending_article()
        {
            Post::factory()->temporalBlog()->create(['title' => 'Published tomorrow', 'publication_date' => now()->addDay(), 'published' => 1]);
            $this->assertDatabaseHas('temporal_names', ['name' => 'blog']);
            $this->assertDatabaseHas('posts', ['title' => 'Published tomorrow', 'published' => 1]);
            $this->get('blog')->assertNotFound();
        }
    
        /**
         * @test
         */
        public function it_returns_a_404_for_an_empty_temporal_category_with_an_unpublished_article()
        {
            Post::factory()->temporalBlog()->create(['title' => 'Unpublished', 'publication_date' => now()->subDay(), 'published' => 0]);
            $this->assertDatabaseHas('temporal_names', ['name' => 'blog']);
            $this->assertDatabaseHas('posts', ['title' => 'Unpublished', 'published' => 0]);
            $this->get('blog')->assertNotFound();
        }
    }
