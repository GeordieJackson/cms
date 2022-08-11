<?php
    
    namespace App\Http\Livewire;
    
    use App\Models\VisitorTracker;
    use Facades\App\Services\Flash;
    use Livewire\Component;
    
    use function collect;
    use function count;
    
    class Stats extends Component
    {
        public string $groupBy = 'remote_addr';
        public bool $errors = true;
        public bool $bots = false;
        public bool $visits = true;
        public $visitors;
        
        public function render()
        {
            $this->setStats();
            
            return view('livewire.stats');
        }
        
        protected function setStats()
        {
            $result = VisitorTracker::orderBy('created_at', 'desc')
                ->when($this->visits, function($query) {
                    $query->orWhere(function($query) {
                        $query->where('is_bot', '=', false)
                            ->when($this->errors, function($query) {
                                $query->orWhere('status_code', '>', 399)
                                    ->where('is_bot', false);
                            })
                            ->when(! $this->errors, function($query) {
                                $query->where('status_code', '<', 400);
                            });
                    });
                })
                ->when($this->bots, function($query) {
                    $query->orWhere(function($query) {
                        $query->where('is_bot', '=', true)
                            ->when($this->errors, function($query) {
                                $query->orWhere('status_code', '>', 399)
                                    ->where('is_bot', true);
                            })
                            ->when(! $this->errors, function($query) {
                                $query->where('status_code', '<', 400);
                            });
                    });
                })
                ->when(! $this->bots && ! $this->visits && $this->errors, function($query) {
                    $query->where('status_code', '>', 399);
                })
                ->get();
            
            if(count($result)) {
                $this->visitors = $result->groupBy($this->groupBy)
                    ->map(fn($item) => $item->sortBy('created_at')->values()
                    );
            } else {
                $this->visitors = collect();
            }
        }
        
        public function deleteAll()
        {
            VisitorTracker::truncate();
            Flash::success("All records deleted");
        }
        
        public function delete($id)
        {
            VisitorTracker::where($this->groupBy, '=', $id)->delete();
            Flash::success("Record deleted" . $this->groupBy . ' ' . $id);
        }
    }