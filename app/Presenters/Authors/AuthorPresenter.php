<?php
    
    namespace App\Presenters\Authors;
    
    use App\Models\Users\User;
    use Facades\App\Services\Breadcrumb;
    use Illuminate\Database\Eloquent\Collection;

    use function pageType;
    use function view;
    
    class AuthorPresenter extends BaseAuthorPresenter
    {
        protected $posts;
        protected $author;
        protected $breadcrumb;
        
        public function __construct(User $author)
        {
            parent::__construct();
            
            $this->author = $author;
            $this->breadcrumb = Breadcrumb::fromAuthor($this->author);
        }
        
        public function toResponse($request)
        {
            return view('front.pages.authors.show')->with(
                [
                    'meta' => $this->meta,
                    'author' => $this->author,
                    'breadcrumb' => $this->breadcrumb,
                ]
            );
        }
    }
