<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Workforce\Employee;
use App\Services\MasterService;
use Illuminate\Support\Facades\Log;

class UserService extends MasterService
{
    public function createUser(array $data)
    {
        return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function showUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function showUserByEmployeeId($id)
    {
        return User::where('employee_id', $id)->first();
    }

    public function createOrUpdateUserByEmployeeId($id, array $data)
    {

        $user = User::where('employee_id', $id)->first();
        $employee = Employee::find($id);
        $role = Role::find($employee->role_id);

        // Check if the password field exists and is not null in the $data array
        $password = isset($data['password']) && !empty($data['password']) ? bcrypt($data['password']) : null;

        $imagePath = null;
        if (isset($data['url_image']) && $data['url_image'] instanceof \Illuminate\Http\UploadedFile) {
            // Save the image to a desired directory, for example, 'uploads/profile_pictures'
            $imagePath = $data['url_image']->store('profile_pictures', 'uploads');
        }

        if ($user) {
            // Update the existing user
            $user->name = $data['name'];
            $user->email = $data['email'];

            // Only update password if a new one is provided
            if ($password) {
                $user->password = $password;
            }

            // Update the profile image URL if a new image is uploaded
            if ($imagePath) {
                $user->url_image = 'uploads/' . $imagePath;
            }

            $user->save();
        } else {
            // Create a new user
            $user = User::create([
                'employee_id' => $id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $password ?: bcrypt(Str::random(8)), // If no password is provided, set a random one
                'url_image' => $imagePath, // Store the uploaded image path if present
            ]);
        }

        $user->syncRoles([$role]);
    }
}
