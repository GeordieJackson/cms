<?php
    
    namespace App\Observers;
    
    use App\Models\TemporalNames\TemporalName;
    use Facades\App\Actions\Posts\BuildActiveTemporalNames;
    use Facades\App\Services\Flash;
    
    class TemporalNamesObserver
    {
        public function created(TemporalName $temporalName)
        {
            Flash::success("Your section {$temporalName->name} was created.");
            $this->updateCache();
        }
        
        public function updated(TemporalName $temporalName)
        {
            Flash::success("Section {$temporalName->name} was updated.");
            $this->updateCache();
        }
        
        public function deleted(TemporalName $temporalName)
        {
            Flash::success("Section {$temporalName->name} was deleted.");
            $this->updateCache();
        }
        
        public function restored(TemporalName $temporalName)
        {
            $this->updateCache();
        }
        
        public function forceDeleted(TemporalName $temporalName)
        {
            $this->updateCache();
        }
        
        protected function updateCache()
        {
            BuildActiveTemporalNames::execute();
        }
    }