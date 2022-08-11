<?php

    namespace Tests\Feature\Backend\Dashboard\posts;

    use Livewire\Livewire;
    use Tests\TestCase;
    use App\Models\Posts\Post;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function collect;
    use function factory;
    use function route;

    /**
     *  Who can see whose posts (own or all)
     *
     * Class PostAccessTest
     * @package Tests\Feature\Backend\Dashboard\posts
     */
    class PostAccessTest extends TestCase
    {
        use RefreshDatabase;

        protected $author;
        protected $editor;
        protected $admin;
        protected $authorAmount = 3;
        protected $editorAmount = 5;

        protected function setUp() : void
        {
            parent::setUp();

            $this->author = UserRoleFactory::withRole('author')->withPermissions('see.dashboard')->create();
            $this->editor = UserRoleFactory::withRole('editor')->withPermissions(['see.dashboard',
                'manage.posts'])->create();
            $this->admin = UserRoleFactory::withRole('admin')->create();
        }
        
        /** @test  */
        function posts_management_livewire_component_is_included_on_page()
        {
            $this->signIn($this->editor);
            $this->get(route('dashboard.posts.index'))->assertSeeLivewire('posts-management-table');
        }

        protected function persistAtricles()
        {
            Post::factory()->count($this->authorAmount)->create(['owner_id' => $this->author->id]);
            Post::factory()->count($this->editorAmount)->create(['owner_id' => $this->editor->id]);
        }

        /**
         * @test
         */
        public function restricted_users_can_see_their_own_posts_but_not_others_posts()
        {
            $this->signIn($this->author);
            $this->persistAtricles();
            $posts = Livewire::test('posts-management-table')->viewData('posts');
            $this->assertEquals($this->authorAmount, $posts->count());
        }

        /**
         * @test
         */
        public function allowed_users_can_access_all_posts()
        {
            $this->signIn($this->editor);
            $this->persistAtricles();
            $posts = Livewire::test('posts-management-table', ['paginate' => $this->authorAmount + $this->editorAmount + 1])->viewData('posts');
            $this->assertEquals($this->authorAmount + $this->editorAmount, $posts->count());
        }

        /**
         * @test
         */
        public function admins_can_access_all_posts()
        {
            $this->signIn($this->admin);
            $this->persistAtricles();
            $posts = Livewire::test('posts-management-table', ['paginate' => $this->authorAmount + $this->editorAmount + 1])->viewData('posts');
            $this->assertEquals($this->authorAmount + $this->editorAmount, $posts->count());
        }

        /**
         * @test
         */
        public function restricted_users_can_edit_their_own_posts()
        {
            $this->withoutExceptionHandling();
            $this->persistAtricles();
            $post = Post::where('owner_id', $this->author->id)->first();
            $this->signIn($this->author);
            $this->get(route('dashboard.posts.edit', $post->id))
                ->assertOk();
        }

        /**
         * @test
         */
        public function restricted_users_cannot_edit_others_posts()
        {
            $this->persistAtricles();
            $post = Post::where('owner_id', $this->editor->id)->first();
            $this->signIn($this->author);

            $this->get(route('dashboard.posts.edit', $post->id))
                ->assertStatus(404);
        }

        /**
         *  This one ensures that the global scope that prevents restricted users from accessing
         *  others' posts in the back end doesn't prevent them viewing them at the front end
         *
         * @test
         */
        public function restricted_users_can_view_others_posts_on_the_front_end()
        {
            $slugs = collect();

            while( ! $slugs->count()) {
                $this->persistAtricles();
                $slugs = $this->getSlugs();
            }

            $this->signIn($this->author);

            $slugs->each(fn($slug) => $this->get($slug)->assertOk());
        }

        /**
         * @return mixed
         */
        protected function getSlugs()
        {
            return Post::where('type', "!=", 1) // Don't include temporal as their slugs are different
            ->where('owner_id', '!=', $this->author->id)
                ->pluck('slug');
        }

        /**
         *  This one ensures that the global scope that prevents restricted users from accessing
         *  others' temporal posts in the back end doesn't prevent them viewing them at the front end
         *
         * @test
         */
        public function restricted_users_can_view_others_temporal_posts_on_the_front_end()
        {
            Post::factory()->count($this->authorAmount)->temporal()->create(['owner_id' => $this->author->id]);
            Post::factory()->count($this->editorAmount)->temporal()->create(['owner_id' => $this->editor->id]);
            $posts = $this->getTemporalPosts();
            $this->signIn($this->author);
            $posts->each(fn($post) => $this->get($post->temporal->name . "/" . $post->slug)->assertOk());
        }

        /**
         * @return mixed
         */
        protected function getTemporalPosts()
        {
            return Post::where('type', 1)
                ->with('temporal')
                ->where('owner_id', '!=', $this->author->id)->get();
        }
    }
