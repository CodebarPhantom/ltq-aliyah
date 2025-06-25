<?php

namespace App\Services;

use App\Models\Location;
use App\Services\MasterService;

class LocationService extends MasterService
{
    public function storeLocation(array $data)
    {
        $location = Location::create($data);
        return $location;
    }

    public function showLocation(int $id)
    {
        return Location::where('id', $id)->first();
    }

    public function updateLocation($id, array $data)
    {
        $location = Location::find($id);
        $location->update($data);
        return $location;
    }

    public function deleteLocation($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return $location;
    }
    public function getAllLocation()

    {
        return Location::active()->get();
    }
}
