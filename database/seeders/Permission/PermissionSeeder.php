<?php
namespace Database\Seeders\Permission;

use App\Models\PermissionGroup;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Helper function to create permission group and permissions if they don't exist
        $this->createPermissionGroupWithPermissions('Perusahaan - Entitas', [
            'entity-read',
            'entity-create',
            'entity-update',
            'entity-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Lokasi', [
            'company-read',
            'company-create',
            'company-update',
            'company-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Divisi', [
            'division-read',
            'division-create',
            'division-update',
            'division-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Departemen', [
            'department-read',
            'department-create',
            'department-update',
            'department-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Jabatan', [
            'role-read',
            'role-create',
            'role-update',
            'role-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Grup Hak Akses', [
            'permission-group-read',
            'permission-group-create',
            'permission-group-update',
            'permission-group-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Perusahaan - Hak Akses', [
            'permission-read',
            'permission-create',
            'permission-update',
            'permission-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Karyawan', [
            'employee-read',
            'employee-create',
            'employee-update',
            'employee-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Base - Bank', [
            'base-bank-read',
            'base-bank-create',
            'base-bank-update',
            'base-bank-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Akun - User', [
            'users-read',
            'users-create',
            'users-update',
            'users-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Aktifitas Saya - Persetujuan', [
            'approve-leave-coworker',
            'approve-permit-coworker',
            'approve-business-trip-coworker',
            'approve-cash-receipt-coworker',
            'approve-overtime-coworker',
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Formulir - Cuti', [
            'workforce-leave-read',
            'workforce-leave-create',
            'workforce-leave-update',
            'workforce-leave-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Formulir - Dinas Luar', [
            'workforce-business-trip-read',
            'workforce-business-trip-create',
            'workforce-business-trip-update',
            'workforce-business-trip-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Formulir - Izin', [
            'workforce-permit-read',
            'workforce-permit-create',
            'workforce-permit-update',
            'workforce-permit-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Formulir - Lembur', [
            'workforce-overtime-read',
            'workforce-overtime-create',
            'workforce-overtime-update',
            'workforce-overtime-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Jadwal Kerja - Shift', [
            'work-schedule-shift-read',
            'work-schedule-shift-create',
            'work-schedule-shift-update',
            'work-schedule-shift-delete'
        ]);
        $this->createPermissionGroupWithPermissions('Jadwal Kerja - Hari Libur', [
            'work-schedule-holiday-read',
            'work-schedule-holiday-create',
            'work-schedule-holiday-update',
            'work-schedule-holiday-delete'
        ]);

        $this->createPermissionGroupWithPermissions('Laporan - Tenaga Kerja', [
            'report-employee-attendance',
            'report-employee-shift',
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Payroll', [
            'workforce-payroll-read',
            'workforce-payroll-create',
            'workforce-payroll-update',
            'workforce-payroll-delete',
        ]);

        $this->createPermissionGroupWithPermissions('Tenaga Kerja - Pinjaman', [
            'workforce-loan-read',
            'workforce-loan-create',
            'workforce-loan-update',
            'workforce-loan-delete',
        ]);

    }

    /**
     * Create a permission group with associated permissions.
     * If the permission group or permissions already exist, they will not be created again.
     */
    private function createPermissionGroupWithPermissions($groupName, array $permissions)
    {
        // Use firstOrCreate to check if the group already exists
        $permissionGroup = PermissionGroup::firstOrCreate(['name' => $groupName,'slug'=>Str::slug($groupName)]);

        // Loop through permissions and use firstOrCreate to prevent duplicates
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
                'permission_group_id' => $permissionGroup->id
            ]);
        }
    }
}

