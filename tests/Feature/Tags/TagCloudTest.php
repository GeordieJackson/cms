<?php
    
    namespace Tests\Feature\Tags;
    
    use App\Models\Posts\Post;
    use Facades\App\Models\Tags\Tag;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class TagCloudTest extends TestCase
    {
        use RefreshDatabase;
        
        /** @test */
        function it_fetches_active_tags_when_set()
        {
            $tagCount = 30;
            $attachedTags = collect([5, 2, 14, 13, 2, 7, 13, 25, 29, 29]); // Make sure there are some duplicates
            Tag::factory()->count($tagCount)->create();
            for ($i = 0; $i < 10; $i++) {
                Post::factory()->temporalBlog()->create()->tags()->attach($attachedTags[$i]);
            }
            
            $tags = Tag::activeTags();
            
            $this->assertEquals($attachedTags->unique()->count(), $tags->count()); // i.e. unique values
            $this->assertEqualsCanonicalizing($attachedTags->unique(), $tags->pluck('id')); // Same values in both - i.e. none with count == 0
        }
    }