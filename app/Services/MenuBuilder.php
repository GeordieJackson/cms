<?php
    
    namespace App\Services;
    
    use App\Http\Controllers\Controller;
    use App\Models\Categories\Category;
    
    use function abort_unless;
    use function is_null;
    use function is_string;
    use function route;
    use function str_replace;
    
    class MenuBuilder extends Controller
    {
        private static $categoryTree = null;
        
        /**
         * @return string
         */
        public function htmlMenu($category = null): string
        {
            abort_unless($data = $this->getData($category), 404, "Category $category does not exist");
            
            $this->addVisibilityFlagsTo($data);
            
            return $this->makeHtmlMenuFrom($data);
        }
        
        // This is just for display in the backend categories management
        public function makeBackendMenuFrom($categories)
        {
            static $categoryTree;
            $categoryTree .= '<ul>';
            
            $categories->each(function ($category) use (&$categoryTree) {
                $categoryTree .= '<li>'.$category->displayName.PHP_EOL;
                
                if ($category->descendants->count()) {
                    $this->makeBackendMenuFrom($category->descendants);
                }
                
                $categoryTree .= '</li>';
            });
            $categoryTree .= '</ul>'.PHP_EOL;
            $categoryTree = str_replace('<ul></ul>'.PHP_EOL, '', $categoryTree);
            
            return $categoryTree;
        }
        
        /**
         *  Used in testing as the static var persists in tests
         */
        public function resetMenuTree()
        {
            self::$categoryTree = null;
        }
        
        /**
         *  Checks category article count, and recursively for subcategories,
         *  then sets a show/hide property on the Category for presentation
         *
         * @param $categories
         * @return mixed
         */
        protected function addVisibilityFlagsTo($categories)
        {
            return $categories->map(function ($category) {
                $show = false;
                if ($category->descendants->count()) {
                    $show = $this->addVisibilityFlagsTo($category->descendants)
                        ->pluck('show')
                        ->flatten()
                        ->contains(true);
                }
                $category->show = $category->count ? true : $show;
                
                return $category;
            });
        }
        
        protected function makeHtmlMenuFrom($categories)
        {
            self::$categoryTree .= '<ul>';
            
            $categories->each(function ($category) use (&$categories) {
                if ($category->show) {
                    // Non clickable links for empty parent categories
                    if ($category->count) {
                        self::$categoryTree .= '<li><a href="'.route('categories.show',
                                ['category' => $category->slug]).'">'.$category->displayName.'</a>'.PHP_EOL;
                    } else {
                        self::$categoryTree .= '<li><a>'.$category->displayName.'</a>'.PHP_EOL;
                    }
                    
                    if ($category->descendants->count()) {
                        $this->makeHtmlMenuFrom($category->descendants);
                    }
                    
                    self::$categoryTree .= '</li>';
                }
            });
            
            self::$categoryTree .= '</ul>'.PHP_EOL;
            
            /**
             * Yuk! But makes sure nothing is returned when there are no articles
             *  It's probably not required but leave it for now and decide later
             */
            $categoryTree = str_replace('<ul></ul>'.PHP_EOL, '', self::$categoryTree);
            
            //  self::$categoryTree = "";
            
            return $categoryTree;
        }
        
        /**
         * @param  mixed  $category
         * @return Category[]|\LaravelIdea\Helper\App\Models\Categories\_CategoryCollection|\LaravelIdea\Helper\App\Models\Categories\_CategoryQueryBuilder|mixed
         */
        protected function getData($category)
        {
            if (is_null($category)) {
                $data = Category::orderBy('name')->orderedByLevel();
            }
            
            if (is_string($category)) {
                if ($cat = Category::whereSlug($category)->first()) {
                    $data = $cat->descendants;
                } else {
                    $data = null;
                }
            }
            
            if ($category instanceof Category) {
                $data = $category->descendants;
            }
            //      dd($data);
            return $data;
        }
    }
