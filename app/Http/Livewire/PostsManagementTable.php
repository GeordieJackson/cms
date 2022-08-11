<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    use Livewire\Component;
    use Livewire\WithPagination;
    
    class PostsManagementTable extends Component
    {
        use WithPagination;
        
        public $paginate;
        public $authors;
        public $authorId = 0;
        public $typeId = 0;
        public $publishedId = 2;
        public $searchTerm = '';
        
        public function mount($paginate = 15) // Set the default here, so it can be overridden by tests.
        {
            $this->authors = User::when(Gate::denies('manage.posts'), function ($query) {
                $query->where('id', Auth::user()->id);
            })->orderBy('forename')->get();
            
            $this->paginate = $paginate;
        }
        
        public function render()
        {
            return view('livewire.posts-management-table')
                ->with(['posts' => $this->getPosts()]);
        }
        
        public function updatingType()
        {
            $this->resetPage();
        }
        
        public function updatingAuthorId()
        {
            $this->resetPage();
        }
        
        public function updatingPublishedId()
        {
            $this->resetPage();
        }
        
        protected function getPosts()
        {
            return Post::withoutGlobalScope('filtered')
                ->when($this->authorId, function ($query) {
                    $query->whereOwnerId($this->authorId);
                })
                ->when($this->typeId, function ($query) {
                    $query->whereType($this->typeId);
                })
                ->when($this->publishedId < 2, function ($query) {
                    $query->wherePublished($this->publishedId);
                })
                ->when($this->searchTerm, function ($query) {
                    $query->where('title', 'like', "%{$this->searchTerm}%");
                })
                ->orderBy('updated_at', 'desc')
                ->paginate($this->paginate);
        }
    }