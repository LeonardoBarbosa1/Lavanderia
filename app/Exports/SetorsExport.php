<?php

namespace App\Exports;

use App\Models\Setor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SetorsExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['created_at','updated_by','status','id','created_by','updated_at','descricao'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Setor::when($this->term, function($query, $term){
            $query->where("updated_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("descricao","ILIKE","%".$term."%")
	;
        })->get();
    }
}
