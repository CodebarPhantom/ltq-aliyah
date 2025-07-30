<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['form_code','name'];

    public function categories()
    {
        return $this->hasMany(QuestionCategory::class, 'form_id')
                    ->orderBy('order');
    }
}
