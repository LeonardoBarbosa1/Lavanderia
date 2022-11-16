<?php

namespace App\Exports;

use App\Models\Estado;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstadosExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['updated_by','updated_at','id','status','created_at','created_by','nome','sigla'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Estado::when($this->term, function($query, $term){
            $query->where("updated_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("nome","ILIKE","%".$term."%")
	->orWhere("sigla","ILIKE","%".$term."%")
	;
        })->get();
    }
}
