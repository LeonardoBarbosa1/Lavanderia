<?php

namespace App\Exports;

use App\Models\Fluxo;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FluxosExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['data_saida','data_entrada','id','status','created_at','created_by','updated_at','updated_by','id_pedidos_itens','id_setores','quantidade','observacao'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fluxo::when($this->term, function($query, $term){
            $query->where("data_saida","ILIKE","%".$term."%")
	->orWhere("data_saida","ILIKE","%".$term."%")
	->orWhere("data_entrada","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("id_pedidos_itens","ILIKE","%".$term."%")
	->orWhere("id_setores","ILIKE","%".$term."%")
	->orWhere("quantidade","ILIKE","%".$term."%")
	->orWhere("observacao","ILIKE","%".$term."%")
	;
        })->get();
    }
}
