<?php

    namespace Tests\Feature\AllPosts;

    use App\Models\Posts\Post;
    use Carbon\Carbon;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\Artisan;
    use Tests\TestCase;

    class PublishedAtTest extends TestCase
    {
        use RefreshDatabase;

        public function setUp() : void
        {
            parent::setUp();

            Post::factory()->page()->create([
                'slug' => 'about-us',
                'publication_date' => Carbon::now()->addDay(),
            ]);

            Post::factory()->page()->create(['slug' => 'contact-us', 'publication_date' => Carbon::now()]);

            Post::factory()->categorized()->create([
                'slug' => 'cat-1',
                'publication_date' => Carbon::now(),
            ]);

            Post::factory()->categorized()->create([
                'slug' => 'cat-2',
                'publication_date' => Carbon::now()->addDay(),
            ]);

            Post::factory()->temporalBlog()->create(['slug' => 'bp-1', 'publication_date' => Carbon::now()->addDay()]);
            Post::factory()->temporalBlog()->create(['slug' => 'bp-2', 'publication_date' => Carbon::now()]);
        }

        /**
         * @test
         */
        public function all_posts_publish_at_field_must_be_less_than_now_to_be_displayed()
        {
            $response = $this->get('about-us');
            $response->assertStatus(404);
            $response = $this->get('contact-us');
            $response->assertStatus(200);

            $response = $this->get('cat-1');
            $response->assertStatus(200);
            $response = $this->get('cat-2');
            $response->assertStatus(404);
        }

        /**
         * @test
         */
        public function categorized_frontend_posts_must_be_published_to_be_displayed()
        {
            $response = $this->get('cat-1');
            $response->assertViewHas('post');
            $response = $this->get('cat-2');
            $this->assertEquals(404, $response->getStatusCode());
        }

        /**
        * @test
        */
        public function temporal_posts_publish_at_field_must_be_less_than_now_to_be_displayed()
        {
            $this->get('blog/bp-1')->assertNotFound();
            $this->get('blog/bp-2')->assertOk();
        }
    }
