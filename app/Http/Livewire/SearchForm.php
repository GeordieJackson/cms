<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use Livewire\Component;
    use Livewire\WithPagination;
    
    use function view;
    
    class SearchForm extends Component
    {
        use WithPagination;
        
        public $searchTerm;
        
        public function render()
        {
            return view('livewire.search-form')
                ->with(['posts' => $this->getArticles()]);
        }
        
        public function clearSearch()
        {
            $this->searchTerm = '';
        }
        
        public function updatingSearch()
        {
            $this->resetPage();
        }
        
        public function updated()
        {
            $this->validate(['searchTerm' => 'string|nullable']);
        }
        
        protected function getArticles()
        {
            $this->searchTerm = str_replace(['-', '+', '<', '>', '@', '(', ')', '~', '*'], '', $this->searchTerm);
            
            return Post::filtered()
                ->whereRaw("MATCH(title, meta_description, summary, body) AGAINST(? IN BOOLEAN MODE)", [$this->searchTerm])
                ->where('type', '!=', Post::PAGE)
                ->published()
                ->paginate();
        }
    }