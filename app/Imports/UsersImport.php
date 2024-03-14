<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $studentExist = Student::where('nisn', $row['nisn'])->exists();

            if (!$studentExist) {
                $user = User::create([
                    'name' => $row['nama'],
                    'username' => $row['nisn'],
                    'password' => Hash::make($row['nisn'])
                ]);

                Student::create([
                    'nisn' => $row['nisn'],
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
