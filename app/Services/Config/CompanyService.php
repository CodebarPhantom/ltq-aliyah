<?php

namespace App\Services;

use App\Models\Company;
use App\Services\MasterService;

class CompanyService extends MasterService
{
    public function storeCompany(array $data)
    {
        $company = Company::create($data);
        $this->appLogService->logChange($company, 'created');
        return $company;
    }

    public function showCompany(int $id)
    {
        return Company::where('id', $id)->first();
    }

    public function updateCompany($id, array $data)
    {
        $company = Company::find($id);
        $company->update($data);
        $this->appLogService->logChange($company, 'updated');
        return $company;
    }

    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);

        if ($company->delete()) {
            $this->appLogService->logChange($company, 'deleted');
        }

        return $company;
    }
    public function getAllCompany()

    {
        return Company::active()->get();
    }
}
