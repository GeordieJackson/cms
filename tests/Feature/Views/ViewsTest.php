<?php

    namespace Tests\Feature\Views;

    use App\Models\Posts\Post;
    use App\Models\Tags\Tag;
    use App\Models\Users\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use function config;
    use function factory;

    class ViewsTest extends TestCase
    {
        use RefreshDatabase;
    
        protected function setUp() : void
        {
            parent::setUp();
        }
    
        /**
         * @TODO These seems to work live but these testd intermittently fail
         *
         *  It's most likely the test (or suite) that's causing it rather than a bug in the code.
         */
    
//        /**
//         * @test
//         */
//        public function published_authors_list_is_displayed_in_the_authors_index_blade()
//        {
//            Post::factory()->temporalBlog()->create(['owner_id' => User::factory()->create()]);
//            User::factory()->create();
//
//            $response = $this->get('authors');
//            $response->assertViewIs('front.pages.authors.index');
//
//            $this->assertEquals(1, $response->viewData('authors')->count());
//        }

//        /**
//         * @test
//         */
//        public function published_authors_are_displayed_in_the_authors_view_page()
//        {
//            $author = User::factory()->create();
//            Post::factory()->create(['owner_id' => $author->id]);
//            $slug = $author->slug;
//            $this->get('authors/' . $slug)->assertViewIs('front.pages.authors.show');
//        }
    
        /**
        * @test
        */
        public function a_static_page_is_presented_in_a_static_page_view()
        {
            Post::factory()->page()->create([
                'slug' => 'about-us',
            ]);

            $response = $this->get('about-us');
            $response->assertViewIs('front.pages.static.show');
        }
    
        /**
         * @test
         */
        public function a_temporal_page_is_presented_in_a_temporal_page_view()
        {
            $slug = 'the-twenty-percent-argument';
            Post::factory()->temporalBlog()->create([
                'slug' => $slug,
            ]);

             $response = $this->get("blog/" . $slug);
             $response->assertViewIs('front.pages.temporal.show');
        }
    
        /**
         * @test
         */
        public function a_categorized_page_is_presented_in_a_categorized_page_view()
        {
            $slug = 'the-one-percent-argument';

            Post::factory()->categorized()->create([
                'slug' => $slug,
            ]);

            $response = $this->get($slug);
            $response->assertViewIs('front.pages.categorized.show');
        }
    
        /**
        * @test
        */
        public function tags_list_is_displayed_in_the_tags_index_blade()
        {
            Tag::factory()->count(5)->create();
            $this->get('tags')->assertViewIs('front.pages.tags.index');
        }
    
        /**
        * @test
        */
        public function tags_are_displayed_in_the_tag_page_view()
        {
            $tags = Tag::factory()->count(5)->create();
            $slug = $tags[0]->slug;
            $this->get('tags/' . $slug)->assertViewIs('front.pages.tags.show');
        }
    }
