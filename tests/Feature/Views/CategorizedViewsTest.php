<?php

    namespace Tests\Feature\Views;

    use App\Models\Posts\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class CategorizedViewsTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function categorized_page_contains_meta_data()
        {
            $slug = 'the-two-percent-argument';
            $metaDescription = 'An article about the two percent argument';

            Post::factory()->categorized()->create([
                'slug' => $slug,
                'meta_title' => 'The two percent argument',
                'meta_description' => $metaDescription,
                'meta_keywords' => 'keyword 1, keyword2',
            ]);

            $this->get($slug)
                ->assertViewIs('front.pages.categorized.show')
                ->assertViewHas('meta')
                ->assertSee($metaDescription)
                ->assertViewHas('author')
                ->assertViewHas('publication_date')
            ;
        }

        /**
         * @test
         */
        public function categorized_page_contains_article_header_info()
        {
            Post::factory()->categorized()->create(['slug'  => 'categorized-post']);
            $this->get('categorized-post')
                ->assertViewHas('author')
                ->assertViewHas('publication_date');
        }
    }
