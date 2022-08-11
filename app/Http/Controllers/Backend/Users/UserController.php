<?php

    namespace App\Http\Controllers\Backend\Users;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\UserUpdateRequest;
    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use App\Presenters\Users\UserEditPresenter;
    use App\Presenters\Users\UserIndexPresenter;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;
    use function back;

    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $users = User::with('roles')->index()->get();

            return new UserIndexPresenter($users);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            // $user = User::whereId($id)->first();
            // dd($user);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(int $id)
        {
            $this->guard($id);
            $user = User::with('roles')->byId($id)->firstOrFail();
            $roles = Role::all();

            return new UserEditPresenter($user, $roles);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(UserUpdateRequest $request, $id)
        {
            $this->guard($id);
            $user = User::byId($id)->firstOrFail();
            $user->fill($request->validated());
            $user->save();
            $user->roles()->sync($request->roles);

            return back();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            return "Delete: $id";
        }

        protected function guard($id)
        {
            abort_unless(Gate::allows('manage.users') || auth()->id() == $id, 403);
        }
    }
