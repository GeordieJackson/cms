<?php

    namespace Tests\Feature\Views;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class TemporalViewsTest extends TestCase
    {
        use RefreshDatabase;

        public function setUp() : void
        {
            parent::setUp();
            $this->withoutExceptionHandling();
        }

        /**
         * @test
         */
        public function temporal_page_contains_meta_data()
        {
            Post::factory()->temporalBlog()->create([
                'slug' => 'temporal-post',
                'meta_title' => 'Temporal post',
                'meta_description' => 'This is the page description',
                'meta_keywords' => 'keyword 1, keyword 2',
            ]);

            $response = $this->get('blog/temporal-post');
            $response->assertViewHas('meta');
            $response->assertSee('Temporal post');
            $response->assertSee('This is the page description');
            $response->assertSee('keyword 1, keyword 2');
        }

        /**
        * @test
        */
        public function temporal_page_contains_article_header_info()
        {
            Post::factory()->temporalBlog()->create(['slug'  => 'temporal-post']);
            $response = $this->get('blog/temporal-post');
            $response->assertViewHas('author');
            $response->assertViewHas('publication_date');
        }
    }
