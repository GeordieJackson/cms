<?php

    namespace Tests\Feature\Posts;

    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\TemporalNames\TemporalName;
    use App\Models\Users\User;
    use App\Models\Tags\Tag;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PostRelationshipsTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function a_post_belongs_to_an_owner()
        {
            $post = Post::factory()->create();

            $this->assertInstanceOf(User::class, $post->owner);
        }

        /**
         * @test
         */
        public function a_post_can_have_a_category()
        {
            $categoryId = Category::factory()->create(['name' => 'categoryName'])->id;
            Post::factory()->categorized()->create(['slug' => 'cat-1', 'category_id' => $categoryId]);

            $response = $this->get('cat-1');
            $this->assertEquals('categoryName', $response->viewData('post')->category()->value('name'));
        }

        /**
         * @test
         */
        public function a_post_category_is_optional() // i.e it can be null or zero
        {
            Post::factory()->categorized()->create(['slug' => 'cat-1', 'category_id' => null]);

            $response = $this->get('/cat-1');
            $this->assertEmpty($response->viewData('post')->category()->value('name'));
        }

        /**
         * @test
         */
        public function a_temporal_post_has_a_temporal_name_relationship_with_a_value()
        {
            $post = Post::factory()->temporal()->create();
            $this->assertInstanceOf(TemporalName::class, $post->temporal);
        }

        /**
         * @test
         */
        public function a_temporal_post_has_a_temporal_name_relationship_without_a_value()
        {
            $post = Post::factory()->temporal()->create(['temporal_id' => null]);
            $this->assertEquals(null, $post->temporal);
        }
    }
