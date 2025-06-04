<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\MasterController;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\EntityService;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class CompanyController extends MasterController
{
    protected $companyService;
    protected $entityService;


    // Inject multiple services through the constructor
    public function __construct(CompanyService $companyService, EntityService $entityService)
    {
        parent::__construct();
        $this->companyService = $companyService;
        $this->entityService = $entityService;

    }

    public function index()
    {
        $func = function () {
            Gate::authorize('readPolicy', Company::class); // is from policy

            $breadcrumbs = ['Perusahaan', 'Lokasi Kantor'];
            $pageTitle = "Lokasi Kantor";
            $this->data = compact('breadcrumbs', 'pageTitle');
        };

        return $this->callFunction($func, view('backoffice.config.company.location.index'));
    }


    public function create()
    {
        $func = function () {
            Gate::authorize('createPolicy', Company::class);

            $breadcrumbs = ['Perusahaan', 'Lokasi Kantor', 'Tambah Lokasi Kantor'];
            $pageTitle = "Tambah Lokasi Kantor";
            $entities = $this->entityService->getAllEntities();
            $this->data = compact('breadcrumbs', 'pageTitle', 'entities');
        };

        return $this->callFunction($func, view('backoffice.config.company.location.create'));
    }

    public function store(Request $request)
    {
        $func = function () use ($request) {

            Gate::authorize('createPolicy', Company::class);

            $data = $request->validate([
                'entity_id' => 'required|string',
                'name' => 'required|string',
                'address' => 'required|string|',
                'phone' => 'required|string|',
                'status' => 'required|boolean|',
                'longitude' => 'required|string|',
                'latitude' => 'required|string|',
                'radius' => 'required|integer|',
            ]);

            $this->companyService->storeCompany($data);
            session()->flash('flashMessageSuccess', 'Task was successful!');
        };

        return $this->callFunction($func, null, 'company.index');
    }

    public function show($id)
    {
        $func = function () use ($id) {
            Gate::authorize('readPolicy', Company::class); // is from policy

            $breadcrumbs = ['Perusahaan', 'Lokasi Kantor', 'Lihat Lokasi Kantor'];
            $pageTitle = "Lihat Lokasi Kantor";
            $editPageTitle = "Ubah Lokasi Kantor";
            $entities = $this->entityService->getAllEntities();
            $company = $this->companyService->showCompany($id);

            $this->data = compact('breadcrumbs', 'pageTitle', 'editPageTitle', 'company', 'entities');
        };

        return $this->callFunction($func, view('backoffice.config.company.location.show'));
    }



    public function edit ($id){
        $func = function () use ($id) {
            Gate::authorize('updatePolicy', Company::class);


            $breadcrumbs = ['Perusahaan', 'Lokasi Kantor', 'Ubah Lokasi Kantor'];
            $pageTitle = "Ubah Lokasi Kantor";

            $company = $this->companyService->showCompany($id);
            $entities = $this->entityService->getAllEntities();

            $this->data = compact('breadcrumbs', 'pageTitle', 'company', 'entities');
        };

        return $this->callFunction($func, view('backoffice.config.company.location.edit'));
    }

    public function update($id, Request $request)
    {
        $func = function () use ($id, $request) {
            Gate::authorize('updatePolicy', Company::class);

            $data = $request->validate([
                'entity_id' => 'required|string',
                'name' => 'required|string',
                'address' => 'required|string|',
                'phone' => 'required|string|',
                'status' => 'required|boolean|',
                'longitude' => 'required|string|',
                'latitude' => 'required|string|',
                'radius' => 'required|integer|',
            ]);

            $this->companyService->updateCompany($id,$data);
            session()->flash('flashMessageSuccess', 'Task was successful!');


        };

        return $this->callFunction($func, null, 'company.index');
    }
}
