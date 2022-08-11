<?php

    namespace Tests\Feature\Observers;

    use Tests\TestCase;
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Facades\App\Services\Flash;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function array_merge;
    use function route;
    use function factory;

    class PostObserverTest extends TestCase
    {
        use RefreshDatabase;

        protected function makeRawArticleFor(User $author) : array
        {
            return Post::factory()->raw(['owner_id' => $author->id, 'type' => Post::PAGE]);
        }

        /**
         * @test
         */
        public function creating_a_new_post_displays_an_alert()
        {
            $author = $this->signInAdminUser();

            $article = $this->makeRawArticleFor($author);
            $this->post(route('dashboard.posts.store'), $article);
            $this->assertDatabaseHas('posts', ['slug' => $article['slug']]);
            $this->get('/')->assertSessionHas('flash');
            $this->assertEquals('alert', Flash::getType());
        }

        /**
         * @test
         */
        public function updating_a_post_displays_an_alert()
        {
            $author = $this->signInAdminUser();
            $article = Post::factory()->create(['owner_id' => $author->id, 'slug' => 'slug', 'type' => Post::PAGE]);
            $update = array_merge($article->attributesToArray(), ['title' => 'new title']);
            $this->assertDatabaseHas('posts', ['slug' => $article['slug']]);
            $this->patch(route('dashboard.posts.update', $article->id), $update);
            $this->assertDatabaseHas('posts', ['title' => 'new title']);
            $this->get('/')->assertSessionHas('flash');
            $this->assertEquals('alert', Flash::getType());
        }
    }
