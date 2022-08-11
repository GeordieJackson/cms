<?php
    
    namespace App\Presenters\Users;
    
    use App\Models\Users\User;
    use Illuminate\Contracts\Support\Responsable;
    use Illuminate\Database\Eloquent\Collection;
    
    class UserEditPresenter implements Responsable
    {
        protected $user;
        
        public function __construct(User $user, Collection $roles)
        {
            $this->user = $user;
            $this->user->roles = $this->user->roles->pluck('id');
            $this->roles = $roles;
        }
        
        /**
         * @inheritDoc
         */
        public function toResponse($request)
        {
            return view('dashboard.users.edit')->with(['user' => $this->user, 'roles' => $this->roles]);
        }
    }
    