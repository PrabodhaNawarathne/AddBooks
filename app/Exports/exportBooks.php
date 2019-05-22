<?php

namespace App\Exports;

use App\Books;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportBooks implements FromCollection,WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {
        return [
           "Title","Author"
        ];
      }

    public function collection()
    {
        return Books::all('title','author');
    }
}
