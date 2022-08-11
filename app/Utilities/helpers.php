<?php
    
    use App\Models\Posts\Post;
    use App\Providers\RouteServiceProvider;
    use Carbon\Carbon;
    
    if (!function_exists('pageType')) {
        function pageType()
        {
            return (object) Post::$types;
        }
    }
    
    if (!function_exists('deslugify')) {
        function deslugify($string)
        {
            $string = str_replace('-', " ", $string);
            $string = str_replace('_', " ", $string);
            
            return $string;
        }
    }
    
    if (!function_exists('publicationDate')) {
        function publicationDate(Carbon $date)
        {
            return $date->isoFormat('Do MMMM Y');
        }
    }
    
    if (!function_exists('publicationDateTime')) {
        function publicationDateTime(?Carbon $date)
        {
            if (!is_null($date)) {
                $date = $date->isoFormat('Do MMM Y H:mm');
            }
            return $date;
        }
    }
    
    if (!function_exists('display')) {
        function display(string $string, string $modifier = '')
        {
            $string = deslugify($string);
            
            if (collect(['f', 'l', 'w', 'u'])->contains($modifier)) {
                $function = match ($modifier) {
                    'f' => 'ucfirst',
                    'l' => 'strtolower',
                    'u' => 'strtoupper',
                    'w' => 'ucwords',
                };
                
                if ($modifier == 'w') {
                    $string = $function(strtolower($string));
                } else {
                    $string = $function($string);
                }
                
                $string = $function($string);
            }
            
            return $string;
        }
    }
    
    /**
     * @NOTE this is called from RouteSerrviceProvider to redirect any urls that contain
     *  or end with 'index' or 'index/php.
     *
     *  It's called as a universal helper to aid with testing
     */
    if (!function_exists('removeIndexFromUrl')) {
        function removeIndexFromUrl(string $requestUri)
        {
            foreach (RouteServiceProvider::INDEXMAP as $index) {
                if( \Illuminate\Support\Str::contains($requestUri, $index)) {
                    $uri = trim(str_replace($index, '', $requestUri, $count), '/');
                    return ['/' . $uri, $count];
                }
            }
        }
    }