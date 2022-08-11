<?php

    namespace Tests\Feature\Routes;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use function config;
    use function factory;

    class RouteStrategyTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp() : void
        {
            parent::setUp();

            Post::factory()->page()->create(['slug' => 'static', 'body' => 'a static page']);
            Post::factory()->page()->create(['slug' => 'unpublished', 'published' => 0]);
            Post::factory()->temporalBlog()->create([
                    'slug' => 'not-blog',
                    'title' => 'A blog entry title',
                ])
            ;
            Post::factory()->categorized()->create([
                    'slug' => 'categorized',
                    'body' => 'a categorized page',
                ])
            ;
            Post::factory()->create(['slug' => 'error', 'type' => 0]);
        }

        /**
         * @test
         */
        public function a_static_post_is_matched_and_returned_in_the_static_blade()
        {
            $this->get('static')
                 ->assertViewIs('front.pages.static.show')
                 ->assertSee('a static page')
            ;
        }

        /**
         * @test
         */
        public function a_categorized_post_is_matched_and_returned_in_the_categorized_blade()
        {
            $this->get('categorized')
                 ->assertViewIs('front.pages.categorized.show')
                 ->assertSee('a categorized page')
            ;
        }

        /**
         * @test
         */
        public function a_temporal_name_is_matched_and_returned_in_the_temporal_index_blade()
        {
            $this->get('blog')->assertViewIs('front.pages.temporal.index');
        }

        /**
         * @test
         */
        public function a_nonexistent_post_404s()
        {
            $this->get('nonexistent')->assertStatus(404);
        }

        /**
         * @test
         */
        public function an_article_with_an_incorrect_type_returns_a_404()
        {
            $this->get('error')->assertStatus(404);
        }

        /**
         * @test
         */
        public function an_unpublished_article_returns_a_404()
        {
            $this->get('unpublished')->assertStatus(404);
        }
    }
