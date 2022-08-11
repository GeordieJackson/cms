<?php
    
    namespace Tests\Feature\Tags;
    
    use App\Models\Posts\Post;
    use App\Models\Tags\Tag;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    use function factory;
    use function route;
    
    class TagsTest extends TestCase
    {
        use RefreshDatabase;
        
        public function setUp(): void
        {
            parent::setUp();
        }
        
        /**
         * @test
         */
        public function posts_have_a_tags_relationship()
        {
            $post = Post::factory()->temporalBlog()->create();
            $this->assertInstanceOf(BelongsToMany::class, $post->tags());
        }
        
        /**
         * @test
         */
        public function tags_have_a_posts_relationship()
        {
            $tag = Tag::factory()->create();
            $this->assertInstanceOf(BelongsToMany::class, $tag->posts());
        }
        
        /**
         * @test
         */
        public function a_post_can_have_tags()
        {
            $post = Post::factory()->temporalBlog()->create();
            $tag = Tag::factory()->create();
            $post->tags()->attach($tag);
            $this->assertEquals($tag->name, $post->tags->first()->name);
        }
        
        /**
         * @test
         */
        public function a_tag_has_posts()
        {
            $post = Post::factory()->temporalBlog()->create();
            $tag = Tag::factory()->create();
            $post->tags()->attach($tag);
            $this->assertEquals($tag->posts->first()->id, $post->id);
        }
        
        /**
         * @test
         */
        public function saving_a_post_with_tags_creates_the_tags_in_the_tags_table()
        {
            $this->signInAdminUser();
            $post = Post::factory()->temporalBlog()->raw(['tags' => 'Tag 1, Tag 2, Tag 3']);
            $this->post(route('dashboard.posts.store'), $post);
            $this->assertDatabaseHas('tags', ['slug' => 'tag-3']);
            $this->assertEquals(3, Post::first()->tags->count());
        }
        
        /**
         * @test
         */
        public function a_tag_is_displayed_in_the_tags_show_blade()
        {
            $tag = Tag::factory()->create();
            $post = Post::factory()->temporalBlog()->create();
            $post->tags()->sync($tag->id);
            
            $this->get(route('tags.show', $tag->slug))
                ->assertViewIs('front.pages.tags.show')
                ->assertSee($post->title);
        }
    }
