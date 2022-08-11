<?php

    namespace App\Http\Controllers\Backend\Acl;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\CreateRoleRequest;
    use App\Http\Requests\DeleteRoleRequest;
    use App\Http\Requests\UpdateRoleRequest;
    use App\Models\Acl\Role;
    use function redirect;

    class RolesController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $roles = Role::orderBy('name')->get();

            return view('dashboard.roles.index')->with(\compact('roles'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(CreateRoleRequest $request)
        {
            Role::create($request->validated());

            return redirect()->action([RolesController::class, 'index']);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateRoleRequest $request, $id)
        {
            Role::whereId($id)->update($request->validated());

            return redirect()->action([RolesController::class, 'index']);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(DeleteRoleRequest $request, $id)
        {
            Role::destroy($id);

            return redirect()->action([RolesController::class, 'index']);
        }
    }
