<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use Livewire\Component;
    use Livewire\WithPagination;
    
    class ArticleList extends Component
    {
        use WithPagination;
        
        protected int $paginate = 10;
        public string $search = '';
        public $author;
        
        public function render()
        {
            return view('livewire.article-list')->with(['posts' => $this->getArticles()]);
        }
        
        public function updatingSearch()
        {
            $this->resetPage();
        }
        
        protected function getArticles()
        {
            return Post::byAuthorId($this->author->id)
                ->where(function ($query) {
                    $query->when($this->search, function ($query) {
                        $query->where('title', 'like', "%{$this->search}%");
                    });
                })
                ->paginate($this->paginate)
                ;
        }
    }