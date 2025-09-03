<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\MasterController;
use App\Services\FormService;
use App\Services\SurahService;
use App\Services\UserService;
use App\Services\EntryHeaderService;
use App\Services\EntryDetailService;


class SummaryController extends MasterController
{

    protected $formService, $surahService, $userService, $entryHeaderService, $entryDetailService;

    // Inject multiple services through the constructor
    public function __construct(FormService $formService, SurahService $surahService, UserService $userService, EntryHeaderService $entryHeaderService, EntryDetailService $entryDetailService)
    {
        parent::__construct();
        $this->formService = $formService;
        $this->surahService = $surahService;
        $this->userService = $userService;
        $this->entryHeaderService = $entryHeaderService;
        $this->entryDetailService = $entryDetailService;
    }

    public function index($formCode)
    {
        $func = function () use ($formCode) {

            $formData = $this->formService->getFormData($formCode);
            $entryHeaders = $this->entryHeaderService->getLastestEntry();
            $chartData = $entryHeaders->map(function ($item) {
                return [
                    'date' => $item->formatted_entry_date,
                    'surah' => $item->surah->name.' - '.$item->surah->name_latin,
                    'page' => $item->page,
                    'verse' => $item->verse_start.'-'.$item->verse_end,
                    'total_errors' => $item->details->sum(function ($detail) {
                        return (int) $detail->string_value;
                    })
                ];
            });
            $breadcrumbs = ['Ringkasan ' . $formData['name']];
            $pageTitle = "Ringkasan " . $formData['name'];
            $this->data = compact('breadcrumbs', 'pageTitle','chartData');
        };

        return $this->callFunction($func, view('summary.index'));
    }
}
