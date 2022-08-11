<?php

    namespace App\Http\Controllers\Backend\Acl;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\CreatePermissionRequest;
    use App\Http\Requests\DeletePermissionRequest;
    use App\Models\Acl\Permission;
    use Illuminate\Http\Request;

    class PermissionsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $permissions = Permission::orderBy('name', 'asc')->get();

            return view('dashboard.permissions.index')->with(\compact('permissions'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(CreatePermissionRequest $request)
        {
            Permission::create($request->validated());

            return \redirect()->action([PermissionsController::class, 'index']);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(CreatePermissionRequest $request, $id)
        {
            Permission::whereId($id)->update($request->validated());

            return \redirect()->action([PermissionsController::class, 'index']);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(DeletePermissionRequest $request, $id)
        {
            Permission::destroy($id);

            return \redirect()->action([PermissionsController::class, 'index']);
        }
    }
