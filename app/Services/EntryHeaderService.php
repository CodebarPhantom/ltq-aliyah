<?php

namespace App\Services;

use App\Models\EntryHeader;
USE Illuminate\Support\Facades\Auth;

class EntryHeaderService
{
    public function createEntryHeader(array $data)
    {
        return EntryHeader::create($data);
    }

    public function getLastestEntry()
    {
        return EntryHeader::with(['surah', 'approver', 'details'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10) // Gunakan take() bukan limit() di Eloquent
            ->get();
    }
}
