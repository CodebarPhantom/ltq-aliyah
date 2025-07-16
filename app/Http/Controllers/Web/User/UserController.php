<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\LocationService;
use App\Http\Controllers\MasterController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends MasterController
{
    protected $userService, $locationService;

    // Inject multiple services through the constructor
    public function __construct(UserService $userService, LocationService $locationService)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->locationService = $locationService;
    }

    public function index()
    {
        $func = function () {
            Gate::authorize('readPolicy', User::class); // is from policy

            $breadcrumbs = ['User'];
            $pageTitle = "User";
            $this->data = compact('breadcrumbs', 'pageTitle');
        };

        return $this->callFunction($func, view('user.index'));
    }

    public function create(Request $request)
    {
        $func = function () use ($request) {

            Gate::authorize('createPolicy', User::class);
            $breadcrumbs = ['User', 'Tambah User'];
            $pageTitle = "Tambah User";
            $locations = $this->locationService->getAllLocations();
            $this->data = compact('breadcrumbs', 'pageTitle', 'locations');
        };

        return $this->callFunction($func, view('user.create'), null);
    }

    public function store(Request $request)
    {
        $func = function () use ($request) {

            Gate::authorize('createPolicy', User::class);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'location_id' => 'required|exists:locations,id',
                'password' => 'required|string|min:6|confirmed',
                //'url_image' => 'nullable|image|max:2048', // max 2MB
            ]);

            // Handle password kosong
            // if (empty($validated['password'])) {
            //     unset($validated['password']); // Jangan kirim password kalau kosong
            // }

            // Handle upload file gambar (jika ada)
            // if ($request->hasFile('url_image')) {
            //     $file = $request->file('url_image');
            //     $path = $file->store('uploads/profile_images', 'public');
            //     $validated['url_image'] = 'storage/' . $path;
            // }

            // Simpan data ke database lewat service layer
            $user = $this->userService->createUser($validated);
            $this->messages = ['User berhasil ditambahkan!'];
            session()->flash('flashMessageSuccess');
            //$this->data = $user;
        };

        return $this->callFunction($func, null, 'users.index');
    }

    public function show($userId)
    {
        $func = function ()  use($userId){
            Gate::authorize('readPolicy', User::class);
            $breadcrumbs = ['User', 'Lihat User'];
            $pageTitle = "Lihat User";
            $user = $this->userService->showUser($userId);
            $editPageTitle = "Ubah User";
            $locations = $this->locationService->getAllLocations();

            $this->data = compact('breadcrumbs', 'pageTitle', 'editPageTitle', 'user','locations');

        };
        return $this->callFunction($func, view('user.show'), null);
    }
}
