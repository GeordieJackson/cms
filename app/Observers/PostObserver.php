<?php
    
    namespace App\Observers;
    
    use App\Models\Posts\Post;
    use Facades\App\Actions\Posts\BuildActiveTemporalNames;
    use Facades\App\Actions\Posts\BuildMenuAction;
    use Facades\App\Actions\Posts\BuildPages;
    use Facades\App\Actions\Posts\SetCategorizedPostCounts;
    use Facades\App\Services\Flash;
    
    class PostObserver
    {
        public function created(Post $post) : void
        {
            Flash::success('Your post was created.');
            $this->updateCaches();
        }
        
        public function updated(Post $post) : void
        {
            Flash::success('Post updated OK');
            $this->updateCaches();
        }
        
        public function deleted(Post $post) : void
        {
            Flash::success('Post deleted OK');
            $this->updateCaches();
        }
        
        public function restored(Post $post) : void
        {
            Flash::success('Post restored OK');
            $this->updateCaches();
        }
        
        public function forceDeleted(Post $post) : void
        {
            Flash::success('Post deleted OK');
            $this->updateCaches();
        }
        
        protected function updateCaches() : void
        {
            SetCategorizedPostCounts::execute();
            BuildMenuAction::execute();
            BuildActiveTemporalNames::execute();
            BuildPages::execute();
        }
    }
