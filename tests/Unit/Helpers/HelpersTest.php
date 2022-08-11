<?php
    
    namespace Tests\Unit\Helpers;
    
    use Illuminate\Support\Str;
    use PHPUnit\Framework\TestCase;

    use function deslugify;
    use function display;

    class HelpersTest extends TestCase
    {
        /** @test  */
        function deslugify_replaces_hyphens_and_underscores_with_spaces()
        {
            $slug = 'this-is_a-slug';
            
            $text = deslugify($slug);
            
            $this->assertStringContainsStringIgnoringCase(' ', $text);
            $this->assertStringNotContainsStringIgnoringCase('-', $text);
            $this->assertStringNotContainsStringIgnoringCase('_', $text);
            $this->assertEquals('this is a slug', $text);
        }
        
        /** @test  */
        function display_returns_the_correct_format()
        {
            /**
             *  Display formats strings for display. It deslugifies, sets to lowercase
             *  then applies a modifier.
             *
             *      'l => 'strtolower'
             *     'f' => 'ucfirst',
             *     'w' => 'strtolower' then 'ucwords',
             *     'u' => 'strtoupper'
             */
            
            $slug = "thIs-IS-a-MixEd-casE-SLUg";
            
            $this->assertEquals('thIs IS a MixEd casE SLUg', display($slug));
            $this->assertEquals('ThIs IS a MixEd casE SLUg', display($slug, 'f'));
            $this->assertEquals('This Is A Mixed Case Slug', display($slug, 'w'));
            $this->assertEquals('THIS IS A MIXED CASE SLUG', display($slug, 'u'));
            
            // Invalid modifier - gets ignored and returns string
            $this->assertEquals('thIs IS a MixEd casE SLUg', display($slug, 'invalid'));
        }
        
        /** @test  */
        function is_crawler_or_bot()
        {
            $agent = 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)';
            
            $result =  Str::contains($agent, ['robot', 'bot', 'crawler']);
            
            $this->assertEquals(1, $result);
        }
    }