<?php
    
    namespace Tests\Feature\Settings;
    
    use Tests\TestCase;

    use function config;

    class TimezoneTest extends TestCase
    {
        /** @test  */
        function timezone_is_set_to_london()
        {
            $this->assertEquals('Europe/London', config('app.timezone'));
        }
    }