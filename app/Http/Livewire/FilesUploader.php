<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use Illuminate\Support\Facades\Storage;
    use Livewire\Component;
    use Livewire\WithFileUploads;
    
    use function str_replace;
    
    class FilesUploader extends Component
    {
        use WithFileUploads;
        
        public $photo;
        public $imageUrl;
        public $originalImageUrl;
        public $saveButtonDisabled = true;
        public $statusMessage = '';
        public $imageNames = [];
        public $post;
    
        public function mount(Post $post)
        {
            $this->post = $post;
            $this->imageUrl = $this->originalImageUrl = $post->image;
            $this->imageNames = $this->getImageNames();
        }
        
        public function updatedPhoto()
        {
            $this->clearStatusMessage();
            
            $this->validate([
                'photo' => 'image|max:1024',
            ]);
            
            $this->imageUrl = $this->photo->getClientOriginalName() ?? $this->originalImageUrl;

            if (Storage::exists('/public/images/'.$this->photo->getClientOriginalName())) {
                $this->statusMessage = "This image already exists";
                $this->saveButtonDisabled = true;
            } else {
                $this->saveButtonDisabled = false;
            }
        }
        
        public function clearStatusMessage()
        {
            $this->statusMessage = '';
        }
        
        public function resetToOriginal()
        {
            $this->photo = null;
            $this->imageUrl = $this->originalImageUrl;
            $this->saveButtonDisabled = true;
            $this->statusMessage = '';
        }
        
        public function save()
        {
            $this->imageUrl = $this->photo->getClientOriginalName();
            $this->photo->storeAs('images', $this->imageUrl, 'public');
            $this->saveButtonDisabled = true;
            $this->statusMessage = 'Image uploaded OK';
        }
        
        public function render()
        {
            return view('livewire.files-uploader');
        }
        
        protected function getImageNames(): array
        {
            return collect(Storage::files("/public/images/"))->map(function ($file) {
                return str_replace('public/images/', '', $file);
            })->sort()->toArray();
        }
    }