<?php
    
    namespace Tests\Feature\Breadcrumb;
    
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\Tags\Tag;
    use App\Models\TemporalNames\TemporalName;
    use App\Models\Users\User;
    use Facades\App\Services\Breadcrumb;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\Artisan;
    use Tests\TestCase;
    
    use function route;
    
    class BreadcrumbTest extends TestCase
    {
        use RefreshDatabase;
        
        protected function setUp(): void
        {
            parent::setUp();
            Artisan::call('db:seed --class='.'Database\\'.'\\Seeders\\'.'\\Tests\\'.'\\CategoriesTestSeeder');
        }
        
        /** @test */
        function it_returns_home_for_index_page()
        {
            $breadcrumb = Breadcrumb::homepage();
            $this->assertStringContainsStringIgnoringCase('Home', $breadcrumb);
        }
        
        /** @test
         *
         * Works for:
         *      static pages
         *      Categories list
         *      Temporal home pages
         *      Authors list
         *      Tags list
         */
        function it_returns_a_home_link_plus_current_location_for_the_FromString_method()
        {
            $string = 'about-us';
            $title = 'About us';
            $breadcrumb = Breadcrumb::fromString($string);
            $this->assertStringContainsString('<a href="'.route('home').'">Home</a>', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase($title, $breadcrumb);
        }
        
        /** @test */
        function it_returns_a_home_link_plus_category_links_and_category_title_for_a_category()
        {
            $category = Category::with('parents')->whereId(12)->first(); // informal fallacies
            $breadcrumb = Breadcrumb::fromCategory($category);
            $this->assertStringNotContainsString(route('categories.show', 'critical-thinking'), $breadcrumb); // No anchor on empty category
            $this->assertStringContainsString('Critical Thinking', $breadcrumb);
            $this->assertStringNotContainsString(route('categories.show', 'fallacies'), $breadcrumb);
            $this->assertStringContainsString('Fallacies', $breadcrumb);
        }
        
        /** @test */
        function it_returns_a_home_link_plus_category_plus_article_title_for_categorized_posts()
        {
            $title = 'This is the title';
            $post = Post::factory()->create([
                'type' => Post::CATEGORIZED,
                'category_id' => 2,
                'title' => $title,
            ]); // Critical thinking
            $breadcrumb = Breadcrumb::fromPost($post);
            $this->assertStringContainsString(route('categories.show', 'critical-thinking'), $breadcrumb);
            $this->assertStringContainsString($title, $breadcrumb);
        }
        
        /** @test */
        function it_returns_a_home_link_plus_categories_plus_article_title_for_nested_categorized_posts()
        {
            $title = 'This is the article title';
            
            $post = Post::factory()->create([
                'type' => Post::CATEGORIZED, 'category_id' => 12, 'slug' => 'this-is-an-article',
                'title' => $title,
            ]); // Informal fallacies
            $breadcrumb = Breadcrumb::fromPost($post);
            $this->assertStringNotContainsString(route('categories.show', 'critical-thinking'), $breadcrumb); // No anchor on empty category
            $this->assertStringContainsString('Critical Thinking', $breadcrumb);
            $this->assertStringNotContainsString(route('categories.show', 'fallacies'), $breadcrumb);
            $this->assertStringContainsString('Fallacies', $breadcrumb);
            $this->assertStringContainsString($title, $breadcrumb);
        }

//
        
        /** @test */
        function it_returns_a_home_link_plus_temporal_text_for_temporal_index()
        {
            $title = 'This is a blog article';
            
            $temporalName = TemporalName::factory()->blog()->create();
            $post = Post::factory()->create([
                'type' => Post::TEMPORAL,
                'temporal_id' => $temporalName->id,
                'title' => $title,
            ]);
            $breadcrumb = Breadcrumb::fromPost($post);
            $this->assertStringContainsStringIgnoringCase('blog', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase($title, $breadcrumb);
        }
        
        /** @test */
        function authors_has_link_plus_name()
        {
            $author = User::factory()->make(['forename' => 'John', 'surname' => 'Jackson']);
            
            $breadcrumb = Breadcrumb::fromAuthor($author);
            $this->assertStringContainsStringIgnoringCase('Home', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase('Authors', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase('John Jackson', $breadcrumb);
        }
        
        /** @test */
        function tags_has_link_plus_name()
        {
            $tag = Tag::factory()->create(['name' => 'Test Slug', 'slug' => 'test-slug']);
            
            $breadcrumb = Breadcrumb::fromTag($tag);
            $this->assertStringContainsStringIgnoringCase('Home', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase('Tags', $breadcrumb);
            $this->assertStringContainsStringIgnoringCase('Test Slug', $breadcrumb);
        }
    }
