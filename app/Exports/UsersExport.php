<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return User::whereHas('student')->with('student')->get()->map(function ($user) {
            return [
                $user->student->nis, 
                $user->student->nisn,
                $user->name,
                $user->gender,
                $user->phone,
                $user->birthday,
                $user->email
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIS',
            'NISN',
            'Nama',
            'Jenis Kelamin',
            'No. HP',
            'Tanggal Lahir',
            'Email'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }
}
