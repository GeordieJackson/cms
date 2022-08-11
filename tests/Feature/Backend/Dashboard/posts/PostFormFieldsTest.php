<?php

    namespace Tests\Feature\Backend\Dashboard\posts;

    use Tests\TestCase;
    use Facades\Tests\Setup\UserRoleFactory;

    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function route;

    class PostFormFieldsTest extends TestCase
    {
        use RefreshDatabase;

        protected $author;
        protected $editor;

        protected function setUp() : void
        {
            parent::setUp();

            $this->author = UserRoleFactory::withRole('author')->withPermissions('see.dashboard')->create();
            $this->editor = UserRoleFactory::withRole('editor')->withPermissions(['see.dashboard',
                'manage.posts'])->create()
            ;
        }

        /**
         * @test
         */
        public function author_options_display_all_authors_in_form_for_those_with_manage_posts_permission()
        {
            $this->signIn($this->editor);
            $this->get(route('dashboard.posts.create'))
                ->assertSee($this->author->name)
                ->assertSee($this->editor->name)
            ;
        }

        /**
         * @test
         */
        public function author_options_display_self_only_in_form_for_those_without_manage_posts_permission()
        {
            $this->signIn($this->author);
            $this->get(route('dashboard.posts.create'))
                ->assertSee($this->author->name)
                ->assertDontSee($this->editor->name)
            ;
        }
    }
