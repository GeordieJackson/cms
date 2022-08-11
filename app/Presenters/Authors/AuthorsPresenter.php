<?php
    
    namespace App\Presenters\Authors;
    
    use Facades\App\Services\Breadcrumb;
    use Illuminate\Database\Eloquent\Collection;
    
    use function view;
    
    class AuthorsPresenter extends BaseAuthorPresenter
    {
        protected Collection $authors;
        protected $breadcrumb;
        
        public function __construct(Collection $authors)
        {
            parent::__construct();
            $this->authors = $authors;
            $this->meta->title = "List of authors";
            $this->breadcrumb = Breadcrumb::fromString('Authors');
        }
        
        public function toResponse($request)
        {
            return view('front.pages.authors.index')->with(
                [
                    'meta' => $this->meta,
                    'authors' => $this->authors,
                    'breadcrumb' => $this->breadcrumb,
                ]
            );
        }
    }
