<?php
    
    namespace App\Presenters\Users;
    
    use Illuminate\Contracts\Support\Responsable;

    use function view;

    class UserIndexPresenter implements Responsable
    {
        protected $users;
        
        public function __construct($users)
        {
            $this->users = $users;
        }
    
        /**
         * @inheritDoc
         */
        public function toResponse($request)
        {
            return view('dashboard.users.index')->with(['users' => $this->users]);
        }
    }