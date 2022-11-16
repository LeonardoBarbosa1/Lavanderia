<?php

namespace App\Exports;

use App\Models\TabelaPreco;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TabelaPrecosExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id','descricao','valor','status','created_at','created_by','updated_at','updated_by'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TabelaPreco::when($this->term, function($query, $term){
            $query->where("descricao","ILIKE","%".$term."%")
	->orWhere("descricao","ILIKE","%".$term."%")
	->orWhere("valor","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	;
        })->get();
    }
}
