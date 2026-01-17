<?php

namespace App\Imports;

use App\RouteBulkTemporary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RouteImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (isset($row['route_name']) && !empty($row['route_name'])) {
            $route_name = $row['route_name'];
            $fare = isset($row['fare']) ? $row['fare'] : null;
            return new RouteBulkTemporary([
                "route_name" => $route_name,
                "fare" => $fare,
                "user_id" => Auth::user()->id
            ]);
        } else {
            return null;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}