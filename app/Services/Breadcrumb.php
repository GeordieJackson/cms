<?php
    
    namespace App\Services;
    
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\Tags\Tag;
    use App\Models\Users\User;
    
    use function array_merge;
    use function array_reverse;
    use function deslugify;
    use function dump;
    use function route;
    use function strtolower;
    use function ucfirst;
    use function ucwords;
    
    class Breadcrumb
    {
        protected array $links;
        
        public function __construct()
        {
            $this->links = [[route('home'), 'Home', 1]];
        }
        
        public function homepage()
        {
            return 'Home';
        }
        
        public function fromString($string)
        {
            return $this->buildBreadcrumb(ucwords(strtolower(deslugify($string))));
        }
        
        public function fromPost(Post $post)
        {
            if ($post->type == Post::CATEGORIZED && $post->category_id) {
                $this->addCategories($post->category);
            }
            
            $this->addTemporalLinks($post);
            $breadcrumb = $this->buildBreadcrumb($post->title);
            
            return $breadcrumb;
        }
        
        public function fromCategory(Category $category)
        {
            if ($category->parents) {
                $this->addCategories($category->parents);
            }
            
            return $this->buildBreadcrumb($category->name);
        }
        
        public function fromAuthor(User $author)
        {
            $this->links [] = [route('authors.index'), 'Authors', 1];
            
            return $this->buildBreadcrumb($author->name);
        }
        
        public function fromTag(Tag $tag)
        {
            $this->links [] = [route('tags.index'), 'Tags', 1];
            
            return $this->buildBreadcrumb(ucwords($tag->name));
        }
        
        protected function addCategories(Category $category)
        {
            // Add current category
            $categories [] = [route('categories.show', $category->slug), ucfirst($category->name), $category->count];
            
            // Add parent categories
            $currentCategory = $category;
            while ($currentCategory = $currentCategory->parents) {
                $categories [] = [route('categories.show', $currentCategory->slug), ucfirst($currentCategory->name), $currentCategory->count];
            }
            
            $categories []= [route('categories.index'), 'Categories',1];
            
            $this->links = array_merge($this->links, array_reverse($categories));
        }
        
        protected function addTemporalLinks(Post $post): void
        {
            if ($post->type !== Post::TEMPORAL) {
                return;
            }
            
            $this->links [] = [route('post', $post->temporal->slug), $post->temporal->name, 1];
        }
        
        protected function buildBreadcrumb(string $string): string
        {
            $breadcrumb = '';
            
            foreach ($this->links as [$slug, $title, $count]) {
                if($count) {
                    $breadcrumb .= '<a href="'.$slug.'">'.ucwords(strtolower(deslugify($title))).'</a>';
                } else {
                    $breadcrumb .= ucwords(strtolower(deslugify($title)));
                }
                
                $breadcrumb .= '<span class="icon-arrow-right"></span>';
            }
            
            $breadcrumb .= deslugify($string);
            
            return $breadcrumb;
        }
    }