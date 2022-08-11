<?php

    namespace Tests\Feature\Authors;

    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    use function factory;

    class AuthorsTest extends TestCase
    {
        use RefreshDatabase;

        public function setUp() : void
        {
            parent::setUp();
        }
        
        /** @test  */
        function no_authors_returns_a_404()
        {
            $this->get('authors')->assertNotFound();
        }

        /**
         * @test
         */
        public function posts_have_an_author_relationship()
        {
            $post = Post::factory()->create();
            $this->assertInstanceOf(BelongsTo::class, $post->owner());
        }

        /**
         * @test
         */
        public function authors_have_a_posts_relationship()
        {
            $author = User::factory()->create();
            $this->assertInstanceOf(HasMany::class, $author->posts());
        }

        /**
         * @test
         */
        public function a_post_has_an_author()
        {
            $author = $this->signIn(User::factory()->create());
            $post = Post::factory()->temporalBlog()->create(['owner_id' => $author->id]);
            $this->assertEquals($author->forename, $post->owner->forename);
        }

        /**
         * @test
         */
        public function an_author_can_have_posts()
        {
            $author = $this->signIn(User::factory()->create());
            Post::factory()->count(5)->create(['owner_id' => $author->id]);
            $this->assertEquals(5, $author->posts->count());
        }

        /**
         * @test
         */
        public function list_of_authors_only_returns_authors_with_post_count_greater_than_zero()
        {
            /**
             * @NOTE: Don't create PAGEs as they're not counted as published for authors
             */
            
            $author1 = User::factory()->create();
            Post::factory()->temporalBlog()->count(5)->create(['owner_id' => $author1->id]);

            $author2 = User::factory()->create();

            $author3 = User::factory()->create();
            Post::factory()->temporalBlog()->count(1)->create(['owner_id' => $author3->id]);

            $this->get(route('authors.index'))
                 ->assertSee($author1->slug)
                 ->assertSee($author3->slug)
                 ->assertDontSee($author2->slug)
            ;
        }
    }
