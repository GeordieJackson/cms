<?php
    
    namespace Tests\Setup;
    
    use Illuminate\Support\Facades\Config;

    class Pagination
    {
        public function setTo(int $value)
        {
            Config::set('settings.paginate', $value);
        }
    
        public function off()
        {
            Config::set('settings.paginate', 500); //
        }
    }