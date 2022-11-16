<?php

namespace App\Exports;

use App\Models\ProgramacaoIten;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgramacaoItensExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id','quantidade','created_at','created_by','updated_at','updated_by','id_setores','id_pedidos_itens'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProgramacaoIten::when($this->term, function($query, $term){
            $query->where("quantidade","ILIKE","%".$term."%")
	->orWhere("quantidade","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("id_setores","ILIKE","%".$term."%")
	->orWhere("id_pedidos_itens","ILIKE","%".$term."%")
	;
        })->get();
    }
}
