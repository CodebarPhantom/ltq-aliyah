<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\MasterController;

class DashboardController extends MasterController
{

    public function index()
    {
        $func = function ()  {
            //Gate::authorize('indexPolicy', User::class); // is from policy
            $breadcrumbs = ['Beranda'];
            $pageTitle = "Beranda Saya";
            $this->data = compact('breadcrumbs','pageTitle');
        };

        return $this->callFunction($func, view('backoffice.dashboard.index'));

    }
}
