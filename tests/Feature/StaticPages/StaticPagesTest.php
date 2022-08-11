<?php

    namespace Tests\Feature\StaticPages;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use function config;

    class StaticPagesTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function it_matches_and_returns_the_home_page()
        {
            Post::factory()->page()->create(['slug' => 'index']);
            $response = $this->get(route('home'));
            $response->assertViewIs('front.pages.static.index');
        }

        /**
         * @test
         */
        public function it_matches_and_returns_static_pages()
        {
            $this->withoutExceptionHandling();
            $states = [
                ['slug' => 'about-us', 'meta_title' => 'About us'],
                ['slug' => 'contact-us', 'meta_title' => 'Contact us'],
            ];

            collect($states)->each(function($state) {
                $post = Post::factory()->page()->create($state);
                $response = $this->get($state['slug']);
                $response->assertViewIs('front.pages.static.show');
                $response->assertViewHas('post');
                $this->assertEquals(Post::PAGE, $response->viewData('post')->type);
            });
        }
    }
