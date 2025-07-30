<?php

namespace App\Services;
use App\Models\Surah;

class SurahService
{
    public function getAllSurahs()
    {
        return Surah::get();
    }
}
