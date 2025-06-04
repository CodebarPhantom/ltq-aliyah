<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\BaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Congregation;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'congregation_id',
        'url_image'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function congregation()
    {
        return $this->hasOne(Congregation::class, 'id', 'congregation_id');
    }

    public function latestNotificationAlls()
    {
        //$employeeView = Employee::where('id', $user->employee_id)->first();

        return $this->hasMany(BaseNotification::class)
            ->where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('for_all_users', true)
                    ->orWhere('mosque_id', Auth::user()->load('congregation')->mosque_id); // Ensure to join with employee relation
            })
            ->latest()
            ->take(10);
    }

    public function latestNotificationForMe()
    {
        return $this->hasMany(BaseNotification::class)
            ->where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->where('mosque_id', null)
                    ->orWhere('for_all_users', true);
            })
            ->latest()
            ->take(10);
    }

    public function latestNotificationDepartment()
    {
        return $this->hasMany(BaseNotification::class)
            ->where('mosque_id', Auth::user()->load('congregation')->mosque_id) // Ensure to join with employee relation
            ->latest()
            ->take(10);
    }

    public function notificationAlls()
    {
        return $this->hasMany(BaseNotification::class)->where('user_id', Auth::user()->id);
    }
}
