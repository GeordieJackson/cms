<?php
    
    namespace Tests\Feature;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    use function removeIndexFromUrl;
    
    class removeIndexFromUrlTest extends TestCase
    {
        use RefreshDatabase;
    
        /**
         * @test
         *
         * @NOTE: This just tests the string manipulation, it doesn't do http requests
         */
        function it_removes_index_php_from_url()
        {
            $map = [
                '/index.php' => '/',
                '/blog/index.php' => '/blog',
                '/index' => '/',
                '/blog/index' => '/blog',
                '/index.php/link' => '/link',
                '/index/link' => '/link',
                '/blog/index.php/link' => '/blog/link',
                '/blog/index/link' => '/blog/link',
            ];
            
            foreach($map as $from => $to) {
                [$redirectUri, $count] = removeIndexFromUrl($from);
                $this->assertEquals($to, $redirectUri);
            }
        }
    }