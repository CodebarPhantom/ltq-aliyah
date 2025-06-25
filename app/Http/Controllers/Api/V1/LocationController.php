<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\MasterController;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\LocationService;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LocationController extends MasterController
{
    protected $locationService;

    // Inject multiple services through the constructor
    public function __construct(LocationService $locationService)
    {
        parent::__construct();
        $this->locationService = $locationService;
    }

    public function dataTable( Request $request){
        Gate::authorize('readPolicy', Location::class); // is from policy

        $search = $request->input('search', ''); // Search query
        $pageSize = $request->input('size', 10); // Default to 10
        $sortField = $request->input('sortField', 'name'); // Default sort field
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sort order

        // Validate sort field and order
        $allowedSortFields = ['name']; // Add your sortable fields
        $allowedSortOrders = ['asc', 'desc'];

        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'name'; // Fallback to default
        }

        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'asc'; // Fallback to default
        }

        $locations = Location::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->whereRaw('name ILIKE ?', ['%'.$search.'%']);
            }
        })
        ->orderBy($sortField, $sortOrder)
        ->paginate($pageSize);

        $locationData = $locations->map(function($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'address' => $location->address,
                'phone' => $location->phone,
                'status'=> $location->status,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'statusName'=> $location->status_name,
                'statusColor' => $location->status_color, // Accessor used here
            ];
        });


                       // Prepare the response
        return response()->json([
            'page' => $locations->currentPage(),
            'pageCount' => $locations->lastPage(),
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'totalCount' => $locations->total(),
            'data' =>  $locationData,
        ]);
    }

    public function destroy($id)
    {
        $func = function () use ($id) {

            Gate::authorize('deletePolicy', Location::class); // is from policy

            $this->locationService->deleteLocation($id);

        };

        return $this->callFunction($func, null, null);
    }
}
