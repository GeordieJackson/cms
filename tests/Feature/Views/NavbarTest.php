<?php

    namespace Tests\Feature\Views;

    use Tests\TestCase;
    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    use function factory;
    use function route;

    class NavbarTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp() : void
        {
            parent::setUp();
            Post::factory()->page()->create(['slug' => 'index']); // Create a home page to visit
        }

        /**
        * @test
        */
        public function the_navbar_displays_the_home_link()
        {
            $this->get(route('home'))->assertSee(route('home'));
        }
        
        /** @test
         *
         *  Make sure that 'index', the DB entry for the home page
         *  does not show up in the navbar
         */
        function it_does_not_display_index_as_a_link()
        {
            $this->get(route('home'))->assertDontSee(route('home') . '/index');
        }

        /**
        * @test
        */
        public function published_static_pages_display_a_button_link()
        {
            Post::factory()->page()->create(['slug' => $slug =  'about-us']);
            $this->get(route('home'))->assertSee($slug);
        }

        /**
        * @test
        */
        public function unpublished_static_pages_dont_display_a_link()
        {
            Post::factory()->page()->create(['slug' => $slug =  'about-us', 'published' => 0]);
            $this->get(route('home'))->assertDontSee($slug);
        }

        /**
        * @test
        */
        public function published_temporal_posts_parent_name_is_displayed_as_a_link()
        {
            Post::factory()->temporalBlog()->create();
            $this->get(route('home'))->assertSee('blog');
        }

        /**
         * @test
         */
        public function unpublished_temporal_posts_parent_name_is_not_displayed_as_a_link()
        {
            Post::factory()->temporalBlog()->create(['published' => 0]);
            $this->get(route('home'))->assertDontSee('blog');
        }
    }
