<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\MasterController;
use App\Models\Surah;
use Illuminate\Http\Request;
use App\Services\FormService;
use App\Services\SurahService;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class FormEntryController extends MasterController
{
     protected $formService, $surahService, $userService;


    // Inject multiple services through the constructor
    public function __construct(FormService $formService, SurahService $surahService, UserService $userService)
    {
        parent::__construct();
        $this->formService = $formService;
        $this->surahService = $surahService;
        $this->userService = $userService;

    }

    public function create($formCode)
    {


        $func = function () use ($formCode) {
        //     // Authorization logic can be added here if needed
            $formData = $this->formService->getFormData($formCode);
            $breadcrumbs = ['Form Entry', 'Create', $formData['name']];
            $surahs = $this->surahService->getAllSurahForSelect();
            $pageTitle = $formData['name'];
            $users = $this->userService->getAllUserForSelect();
            $this->data = compact('breadcrumbs', 'pageTitle', 'formCode','formData','surahs','users');
        };

        return $this->callFunction($func, view('form.entry.create'));
    }
}
