<?php

namespace App\Exports;

use App\Books;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class exportAuthors implements FromCollection,WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {
        return [
           "Author"
        ];
      }

    public function collection()
    {
        $records = Books::all('author');

        return $records;
    }
}
