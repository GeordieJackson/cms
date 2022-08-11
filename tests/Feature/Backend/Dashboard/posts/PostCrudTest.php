<?php
    
    namespace Tests\Feature\Backend\Dashboard\posts;
    
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Validation\ValidationException;
    use Livewire\Livewire;
    use Tests\TestCase;

    use function dump;
    use function factory;
    use function route;
    
    class PostCrudTest extends TestCase
    {
        use RefreshDatabase;
        
        protected $author;
        protected $editor;
        protected $admin;
        
        protected function setUp(): void
        {
            parent::setUp();
            
            $this->author = UserRoleFactory::withRole('author')->withPermissions('see.dashboard')->create();
            $this->editor = UserRoleFactory::withRole('editor')->withPermissions([
                'see.dashboard',
                'manage.posts',
            ])->create();
        }
        
        protected function persistArticles()
        {
            // Use Post::page otherwise the wrong error can get generated
            Post::factory()->count(3)->create(['owner_id' => $this->author->id, 'type' => Post::PAGE]);
            Post::factory()->count(4)->create(['owner_id' => $this->editor->id, 'type' => Post::PAGE]);
        }
        
        protected function makeRawArticleFor(User $author): array
        {
            return Post::factory()->raw(['owner_id' => $author->id, 'type' => Post::PAGE]);
        }
        
        /**
         * @test
         */
        public function the_index_page_displays_all_articles_or_empty_message_for_a_user()
        {
            Livewire::actingAs($this->author);
            
            $posts = Livewire::test('posts-management-table')->viewData('posts');
            $this->assertEquals(0, $posts->count());
            
            $this->persistArticles();
            $posts = Livewire::test('posts-management-table')->viewData('posts');
            $this->assertEquals(3, $posts->count());
        }
        
        /**
         * @test
         */
        public function create_a_new_article_page_displays_ok()
        {
            $this->withoutExceptionHandling();
            $this->signIn($this->author);
            $this->get(route('dashboard.posts.create'))
                ->assertOk()
                ->assertViewIs('dashboard.posts.create');
        }
        
        /**
         * @test
         */
        public function the_store_method_saves_a_post_correctly()
        {
            $author = $this->signIn($this->author);
            $article = $this->makeRawArticleFor($author);
            $this->post(route('dashboard.posts.store'), $article);
            $this->assertDatabaseHas('posts', ['slug' => $article['slug']]);
        }
        
        /**
         * @test
         */
        public function trying_to_save_a_post_with_an_existing_slug_gives_a_validation_error()
        {
            $this->withoutExceptionHandling();
            $author = $this->signIn($this->author);
            $article = $this->makeRawArticleFor($author);
            $this->post(route('dashboard.posts.store'), $article);
            $this->expectException(ValidationException::class);
            $this->post(route('dashboard.posts.store'), $article);
        }
        
        /**
         * @test
         */
        public function the_edit_post_page_displays_ok()
        {
            $this->signIn($this->editor);
            $this->persistArticles();
            $targetArticle = Post::first();
            
            $response = $this->get(route('dashboard.posts.edit', $targetArticle->id))
                ->assertOk()
                ->assertViewIs('dashboard.posts.edit');
            
            $this->assertEquals($this->author->id, $response->viewData('post')['owner_id']);
        }
        
        /**
         * @test
         */
        public function the_update_method_updates_a_post_correctly()
        {
            $this->signInAdminUser();
            $this->persistArticles();
            $count = Post::count();
            $formData = Post::whereOwnerId($this->editor->id)->first()->toArray(); // Make sure owner_id !== 1, so the unique rule is tested properly
            $formData['summary'] = 'Summary updated';
            $this->patch(route('dashboard.posts.update', $formData['id']), $formData);
            $this->assertDatabaseHas('posts', ['summary' => 'Summary updated']);
            $this->assertEquals($count, Post::count());
        }
    }
