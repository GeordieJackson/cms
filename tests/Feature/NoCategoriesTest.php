<?php
    
    namespace Tests\Feature;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class NoCategoriesTest extends TestCase
    {
        use RefreshDatabase;
        
        /** @test */
        function a_404_is_thrown_when_categories_page_is_accessed_but_there_are_no_categories()
        {
            $this->get('categories')->assertNotFound();
        }
    }