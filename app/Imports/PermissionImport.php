<?php

namespace App\Imports;

use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0]) || !isset($row[1])) {
            return null;
        }

        return Permission::updateOrCreate(
            [
                'name'       => trim($row[0]),
                'guard_name' => trim($row[1]),
            ],
            [
                'group_name' => $row[2] ?? null,
            ]
        );
    }
}
