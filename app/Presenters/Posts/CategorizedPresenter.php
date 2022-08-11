<?php
    
    namespace App\Presenters\Posts;
    
    use Facades\App\Services\Breadcrumb;

    use function ucfirst;
    
    class CategorizedPresenter extends BasePostPresenter
    {
        public function prepare($request)
        {
            parent::prepare($request);
            
            $this->setAuthor();
            $this->setPublicationDate();
            $this->breadcrumb = Breadcrumb::fromPost($this->post);
        }
        
        public function toResponse($request)
        {
            $this->prepare($request);
            
            $categoryName = $this->post->category->name ?? null;// A category can be empty
            
            return view('front.pages.categorized.show')->with([
                'meta' => (object) $this->meta,
                'post' => (object) $this->post,
                'author' => $this->author,
                'publication_date' => $this->publication_date,
                'category' => ucfirst($categoryName),
                'breadcrumb' => $this->breadcrumb
            ]);
        }
    }
