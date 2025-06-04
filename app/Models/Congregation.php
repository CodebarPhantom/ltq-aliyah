<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congregation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'no_ktp',
        'pob',
        'dob',
        'address',
        'phone',
        'gender',
        'role_id',
        'is_active',
        'mosque_id',
    ];

    protected $appends = ['is_active_name', 'is_active_color'];

    public function getIsActiveColorAttribute()
    {
        switch ($this->is_active) {
            case 1:
                return 'bg-success';
            case 0:
                return 'bg-danger';
            default:
                return 'bg-danger'; // Default color if status is unknown
        }
    }

    public function getIsActiveNameAttribute()
    {
        switch ($this->is_active) {
            case 1:
                return 'Active'; // Human-readable status name for active
            case 0:
                return 'Inactive'; // Human-readable status name for non-active
            default:
                return 'Unknown'; // Default for unknown status
        }
    }

  

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'congregation_id');
    }
    

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
