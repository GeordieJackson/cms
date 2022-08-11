<?php
    
    namespace App\Presenters\Authors;
    
    use Illuminate\Contracts\Support\Responsable;
    use stdClass;

    abstract class BaseAuthorPresenter implements Responsable
    {
        protected $meta;
        
        public function __construct()
        {
            $this->meta = new stdClass();
        }
    }