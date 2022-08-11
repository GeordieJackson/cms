<?php

    namespace Tests\Feature\Views;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class StaticViewsTest extends TestCase
    {
        use RefreshDatabase;

        public function setUp() : void
        {
            parent::setUp();
            # $this->withoutExceptionHandling();
        }

        /**
         * @test
         */
        public function static_page_contains_meta_data()
        {
            Post::factory()->page()->create([
                'slug' => 'about-us',
                'meta_title' => 'About us',
                'meta_description' => 'This is the page description',
                'meta_keywords' => 'keyword 1, keyword 2',
            ]);

            $response = $this->get('about-us');
            $response->assertViewHas('meta');
            $response->assertSee('About us');
            $response->assertSee('This is the page description');
            $response->assertSee('keyword 1, keyword 2');
        }
    }
