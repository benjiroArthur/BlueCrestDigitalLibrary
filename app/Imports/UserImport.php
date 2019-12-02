<?php

namespace App\Imports;

use App\User;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
class UserImport implements WithHeadingRow, ToCollection, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        return new User([
//            'username' => $row['username'],
//            'password' => Hash::make($row['password']),
//            'role_id' => $row['role_id']
//        ]);

        return null;
    }

public function collection(Collection $rows)
{
    foreach ($rows as $row)
    {
        if($row->filter()->isNotEmpty())
        {
            $user = User::create([
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
            'role_id' => $row['role_id']
        ]);
        }
    }
}
}
