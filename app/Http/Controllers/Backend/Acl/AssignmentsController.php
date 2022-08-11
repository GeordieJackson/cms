<?php

    namespace App\Http\Controllers\Backend\Acl;

    use App\Http\Controllers\Controller;
    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use Illuminate\Http\Request;

    class AssignmentsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('dashboard.assignments.index')->with(['roles' => Role::withoutAdmin()->get(['id', 'name'])]);
        }

        /**
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function show($roleId)
        {
            $role = $this->getRole($roleId);

            return view('dashboard.assignments.show')->with([
                'role' => $role,
                'permissions' => $this->getPermissions(),
                'setPermissions' => $role->permissions->pluck('id')
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $roleId)
        {
            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->input('role_ids'));

            return \redirect()->action([AssignmentsController::class, 'show'], $roleId);
        }

        /**
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function setRole(Request $request)
        {
            if($roleId = $request->input('role_id')) {
                return \redirect()->action([AssignmentsController::class, 'show'], $roleId);
            }

            return \redirect()->action([AssignmentsController::class, 'index']);
        }

        /**
         * @param Request $request
         * @return mixed
         */
        protected function getRole($roleId)
        {
            return Role::with('permissions')->whereId($roleId)->first();
        }

        /**
         * @return mixed
         */
        protected function getPermissions()
        {
            return Permission::orderBy('name')->get(['id', 'name', 'description']);
        }
    }
