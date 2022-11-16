<?php

namespace App\Exports;

use App\Models\Cidade;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CidadesExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id_estados','id','status','created_at','created_by','updated_at','updated_by','nome'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cidade::when($this->term, function($query, $term){
            $query->where("id_estados","ILIKE","%".$term."%")
	->orWhere("id_estados","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("nome","ILIKE","%".$term."%")
	;
        })->get();
    }
}
