<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Buku;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BookExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku::all();
    }
    public function headings(): array
    {
        return [
            'ID', 'Judul', 'Penulis', 'Penerbit', 'Tahun Terbit'
        ];
    }
}
