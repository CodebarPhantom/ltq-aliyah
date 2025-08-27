<?php

namespace App\Services;

use App\Models\EntryHeader;

class EntryHeaderService
{
    public function createEntryHeader(array $data)
    {
        return EntryHeader::create($data);
    }
}
