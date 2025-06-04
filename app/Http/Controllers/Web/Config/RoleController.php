<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Controllers\MasterController;
use App\Models\Role;
use App\Services\PermissionGroupService;
use Illuminate\Support\Facades\Gate;


class RoleController extends MasterController
{
    protected $roleService;
    protected $permissionGroupService;


    // Inject multiple services through the constructor
    public function __construct(RoleService $roleService, PermissionGroupService $permissionGroupService)
    {
        parent::__construct();
        $this->roleService = $roleService;
        $this->permissionGroupService = $permissionGroupService;

    }

    public function index()
    {
        $func = function () {
            Gate::authorize('readPolicy', Role::class);

            $breadcrumbs = ['Perusahaan', 'Jabatan'];
            $pageTitle = "Jabatan";
            $this->data = compact('breadcrumbs', 'pageTitle');
        };

        return $this->callFunction($func, view('backoffice.config.company.role.index'));
    }


    public function create()
    {
        $func = function () {
            Gate::authorize('createPolicy', Role::class);

            $breadcrumbs = ['Perusahaan', 'Jabatan', 'Tambah Jabatan'];
            $pageTitle = "Tambah Jabatan";
            $permissionGroupWithPermissions = $this->permissionGroupService->getAllPermissionGroupWithPermissions();
            $this->data = compact('breadcrumbs', 'pageTitle', 'permissionGroupWithPermissions');
        };

        return $this->callFunction($func, view('backoffice.config.company.role.create'));
    }

    public function store(Request $request)
    {
        $func = function () use ($request){
            Gate::authorize('createPolicy', Role::class);


            $data = $request->validate([
                'permissions' => 'array',
                'name' => 'required|string',
                'is_active'=> 'required|string'
            ]);


            $this->roleService->storeRole($data);
            session()->flash('flashMessageSuccess', 'Task was successful!');
        };

        return $this->callFunction($func, null, 'roles.index');
    }

    public function show($id)
    {
        $func = function () use ($id){
            Gate::authorize('readPolicy', Role::class);


            $breadcrumbs = ['Perusahaan', 'Jabatan', 'Lihat Jabatan'];
            $pageTitle = "Lihat Jabatan";
            $editPageTitle = "Ubah Jabatan";

            $permissionGroupWithPermissions = $this->permissionGroupService->getAllPermissionGroupWithPermissions();
            $role = $this->roleService->showRole($id);

            $this->data = compact('breadcrumbs', 'pageTitle', 'editPageTitle', 'permissionGroupWithPermissions','role');

       };

       return $this->callFunction($func, view('backoffice.config.company.role.show'));

    }

    public function edit ($id){
        $func = function () use ($id) {
            Gate::authorize('updatePolicy', Role::class);

            $breadcrumbs = ['Perusahaan', 'Jabatan', 'Ubah Jabatan'];
            $pageTitle = "Ubah Jabatan";

            $permissionGroupWithPermissions = $this->permissionGroupService->getAllPermissionGroupWithPermissions();
            $role = $this->roleService->showRole($id);

            $this->data = compact('breadcrumbs', 'pageTitle', 'permissionGroupWithPermissions','role');
        };

        return $this->callFunction($func, view('backoffice.config.company.role.edit'));
    }

    public function update($id, Request $request)
    {
        $func = function () use ($id, $request) {
            Gate::authorize('updatePolicy', Role::class);

            $data = $request->validate([
                'permissions' => 'array',
                'name' => 'required|string',
                'is_active'=> 'required|string'
            ]);

            $this->roleService->updateRole($id,$data);
            session()->flash('flashMessageSuccess', 'Task was successful!');


        };

        return $this->callFunction($func, null, 'roles.index');
    }
}
