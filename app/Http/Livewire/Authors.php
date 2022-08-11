<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Livewire\Component;
    use Livewire\WithPagination;
    
    class Authors extends Component
    {
        use WithPagination;
        
        protected int $pagination = 10;
        public string $search = '';
        
        public function render()
        {
            return view('livewire.authors')->with('authors', $this->getAuthors());
        }
        
        public function updatingSearch()
        {
            $this->resetPage();
        }
        
        protected function getAuthors()
        {
            return User::whereHas('posts', function ($posts) {
                $posts->where('type', '!=', Post::PAGE)->published();
            })->withCount([
                'posts' => function ($posts) {
                    $posts->where('type', '!=', Post::PAGE)->published();
                },
            ])
                ->where(function ($query) {
                    $query->when($this->search, function ($query) {
                        $query->where('forename', 'like', "%{$this->search}%")
                            ->orWhere('surname', 'like', "%{$this->search}%");
                    });
                })->orderBy('slug')
                ->paginate($this->pagination);
        }
    }