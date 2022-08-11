<?php

    namespace Tests\Feature\Backend\Dashboard\posts;

    use App\Models\Posts\Post;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class StaticPostsTestCancelled extends TestCase
    {
        use RefreshDatabase;

        /*
        | Permissions can be that an admin has all permissions
        | An editor has all permissions except (hard?) delete
        | An author can only create and edit their own articles
         */

        /**
        * @test
        */
        public function a_user_with_the_correct_permission_can_see_the_page()
        {
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard'])->create();
            $this->signIn($user);

            $this->get( route('dashboard.posts.index'))->assertOk();
        }

        /**
         * @test
         */
        public function a_user_without_the_correct_permission_cannot_see_the_page()
        {
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard'])->create();
            $this->signIn($user);

            $this->get( route('dashboard.posts.index'))->assertStatus(403);
        }

        /**
        * @test
        */
        public function a_user_with_only_own_posts_permission_only_sees_their_own_posts()
        {
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard'])->create();
            $this->signIn($user);
            Post::factory()->count(3)->page()->create(['owner_id' => $user->id]);
            Post::factory()->count(5)->page()->create(['owner_id' => $user->id + 6]);

            $response = $this->get( route('dashboard.posts.index'));
            $this->assertEquals(3, $response->viewData('posts')->count());
        }

        /**
         * @test
         */
        public function a_user_with_all_posts_permission_sees_all_posts()
        {
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard', 'manage.posts'])->create();
            $this->signIn($user);
            Post::factory()->count(3)->page()->create(['owner_id' => $user->id]);
            Post::factory()->count(5)->page()->create(['owner_id' => $user->id + 6]);

            $response = $this->get( route('dashboard.posts.index'));
            $this->assertEquals(8, $response->viewData('posts')->count());
        }

        /**
        * @test
        */
        public function a_valid_user_can_edit_posts()
        {
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard'])->create();
            $this->signIn($user);
            $post = Post::factory()->page()->create(['owner_id' => $user->id]);

            $response = tap($this->get( route('dashboard.static.edit', ['static' => $post->id])))
                ->assertViewHas('post')
            ;

            $this->assertEquals($post->slug, $response->viewData('post')['slug']);
        }

        /**
         * @test
         */
        public function a_valid_user_can_update_posts()
        {
          #  $this->withExceptionHandling();
            $user = UserRoleFactory::withRole('author')->withPermissions(['see.dashboard'])->create();
            $this->signIn($user);
            $post = Post::factory()->page()->create(['owner_id' => $user->id, 'title' => 'original title']);

            $response = tap($this->patch( route('dashboard.static.edit', ['static' => $post->id]), ['title' => 'updated title']));

            $this->assertEquals($post->fresh()->title, $response->viewData('post')['title']);
        }
    }
