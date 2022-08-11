<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\Posts\Post;
    use Illuminate\Support\Facades\Storage;
    use Livewire\Component;
    use Livewire\WithFileUploads;

    use function collect;
    use function str_replace;

    class ImageUploader extends Component
    {
        use WithFileUploads;
        
        public $photo;
        public $imageUrl;
        public $originalImageUrl;
        public $saveButtonDisabled = true;
        public $statusMessage = '';
        public $imageNames;
    
        public function mount()
        {
            $this->imageUrl = $this->originalImageUrl = '';
            $this->imageNames = $this->getImageNames();
        }
    
        public function updatedPhoto()
        {
            $this->clearStatusMessage();
        
            $this->validate([
                'photo' => 'image|max:1024',
            ]);
        
            $this->imageUrl = $this->photo->getClientOriginalName() ?? $this->originalImageUrl;
        
            if (Storage::exists('/public/graphics/'.$this->photo->getClientOriginalName())) {
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
            $this->photo->storeAs('graphics', $this->imageUrl, 'public');
            $this->saveButtonDisabled = true;
            $this->statusMessage = 'Image uploaded OK';
        }
        
        public function render()
        {
            return view('livewire.image-uploader');
        }
    
        protected function getImageNames(): array
        {
            return collect(Storage::files("/public/graphics/"))->map(function ($file) {
                return str_replace('public/graphics/', '', $file);
            })->sort()->toArray();
        }
    }