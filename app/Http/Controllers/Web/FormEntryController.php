<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\MasterController;
use App\Models\Surah;
use Illuminate\Http\Request;
use App\Services\FormService;
use App\Services\SurahService;
use Illuminate\Support\Facades\Log;

class FormEntryController extends MasterController
{
     protected $formService, $surahService;


    // Inject multiple services through the constructor
    public function __construct(FormService $formService, SurahService $surahService)
    {
        parent::__construct();
        $this->formService = $formService;
        $this->surahService = $surahService;

    }

    public function create($formCode)
    {


        $func = function () use ($formCode) {
        //     // Authorization logic can be added here if needed
            $breadcrumbs = ['Form Entry', 'Create'];
            $formData = $this->formService->getFormData($formCode);
            $surahs = $this->surahService->getAllSurahs();
            $pageTitle = $formData['name'];
            $this->data = compact('breadcrumbs', 'pageTitle', 'formCode','formData','surahs');
        };

        return $this->callFunction($func, view('form.entry.create'));
    }
}
