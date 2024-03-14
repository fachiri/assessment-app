<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExampleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $data = [
            [
                'nisn' => 'nisn_siswa_1',
                'name' => 'nama_siswa_1'
            ],
            [
                'nisn' => 'nisn_siswa_2',
                'name' => 'nama_siswa_2'
            ],
            [
                'nisn' => 'dst...',
                'name' => 'dst...'
            ]
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
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
            'A2:B4' => ['font' => ['italic' => true]]
        ];
    }
}
