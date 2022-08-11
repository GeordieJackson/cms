<?php

    namespace Tests\Feature\CategorizedPages;

    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    use function config;
    use function print_r;
    use function array_map;

    class CategorizedPagesTest extends TestCase
    {
        use RefreshDatabase;

        /**
        * @test
        */
        public function it_matches_and_returns_an_article_in_the_correct_view()
        {
            Post::factory()->categorized()->create(['slug' => 'this-is-an-article']);
            
            $response = tap($this->get('this-is-an-article'))
                ->assertViewIs('front.pages.categorized.show')
                ->assertViewHas('post');
            
            $this->assertEquals(Post::CATEGORIZED, $response->viewData('post')->type);
        }

        /**
         * @test
         */
        public function it_404s_when_article_not_matched()
        {
            Post::factory()->categorized()->create(['slug' => 'this-is-an-article']);
            $this->get('this-article-does-not-exist')->assertStatus(404);
        }

        /**
        * @test
        */
        public function a_categorized_article_can_have_an_owner()
        {
            $user = User::factory()->create(['forename' => 'Arthur', 'surname' => 'Bisquits']);
            $post = Post::factory()->categorized()->create(['owner_id' => $user->id, 'slug' => 'this-is-an-article']);

            // Check that the post belongs to the assigned owner
            $this->assertEquals('Arthur', $post->owner->forename);

            $response = $this->get('this-is-an-article');
            // Check that the owner details are available in the view
            $this->assertEquals('Bisquits', $response->viewData('post')->owner->surname);
        }

        /**
        * @test
        */
        public function a_categorized_post_belongs_to_a_category()
        {
            $category = Category::factory()->create(['name' => 'test-category']);
            $post = Post::factory()->categorized()->create(['category_id' => $category->id, 'slug' => 'this-is-an-article']);

            // Check that the post belongs to the assigned category
            $this->assertEquals('test-category', $post->category->name);

            $response = $this->get('this-is-an-article');
            // Check that the category details are available in the view
            $this->assertEquals('test-category', $response->viewData('post')->category->name);
        }
    }
