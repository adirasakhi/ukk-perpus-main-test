<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PeminjamanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::all();
    }
    public function headings(): array
    {
        return [
            'ID', 'User_id','Buku_id', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman'
        ];
    }
}
