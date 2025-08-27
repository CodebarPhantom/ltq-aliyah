<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryHeader extends Model
{
    protected $fillable = ['entry_code','form_id','user_id','surah_id','approver_id','page','verse_start','verse_end','entry_date','notes'];

    public function details()
    {
        return $this->hasMany(EntryDetail::class, 'entry_header_id');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
