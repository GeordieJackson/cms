<?php
    
    namespace App\Presenters\Posts;
    
    use Facades\App\Models\Tags\Tag;
    use Facades\App\Actions\tagListToStringAction;
    use Facades\App\Services\Breadcrumb;

    use function view;
    
    class TemporalPresenter extends BasePostPresenter
    {
        protected $tagList = null;
        protected $tagCloud = null;
        
        public function prepare($request)
        {
            parent::prepare($request);
            
            $this->setAuthor();
            $this->setPublicationDate();
            $this->breadcrumb = Breadcrumb::fromPost($this->post);
            if ($this->post->tags->count()) {
                $this->tagList = $this->post->tags->sortBy('name');
            }
        }
        
        public function toResponse($request)
        {
            $this->prepare($request);
            
            return view('front.pages.temporal.show')->with(
                [
                    'meta' => (object) $this->meta,
                    'post' => (object) $this->post,
                    'author' => (object) $this->author,
                    'publication_date' => (string) $this->publication_date,
                    'tagList' => $this->tagList,
                    'tagCloud' => $this->tagCloud,
                    'breadcrumb' => $this->breadcrumb,
                    'tagCloud' => Tag::activeTags(),
                ]
            );
        }
    }
