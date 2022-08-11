<?php

    namespace Tests\Feature\AllPosts;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class SectionMatchingTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp() : void
        {
            parent::setUp();
          #  $this->withoutExceptionHandling();
        }

        /**
         * @test
         */
        public function a_categorized_article_can_only_match_with_the_content_section()
        {
            Post::factory()->categorized()->create(['slug' => 'categorized-post']);

            $response = $this->get('categorized-post');
            $response->assertStatus(200);

            $response = $this->get('blog/categorized-post');
            $response->assertStatus(404);

            $response = $this->get('zzzz/categorized-post');
            $response->assertStatus(404);
        }


    }
