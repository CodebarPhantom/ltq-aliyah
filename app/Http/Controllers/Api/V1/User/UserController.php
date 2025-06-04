<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\MasterController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends MasterController
{
    protected $userService;

    // Inject multiple services through the constructor
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $func = function () use ($request) {

           Gate::authorize('create', User::class); // is from policy

            $data = $request->validate([
                'name'=> 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            $user = $this->userService->createUser($data);

            // Set the data and messages
            $this->data = $user;
        };

        return $this->callFunction($func, null, null);
    }

}
