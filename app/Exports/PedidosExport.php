<?php

namespace App\Exports;

use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['situacao','id','status','created_at','created_by','updated_at','updated_by','data_pedido','id_clientes','descricao'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pedido::when($this->term, function($query, $term){
            $query->where("situacao","ILIKE","%".$term."%")
	->orWhere("situacao","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("data_pedido","ILIKE","%".$term."%")
	->orWhere("id_clientes","ILIKE","%".$term."%")
	->orWhere("descricao","ILIKE","%".$term."%")
	;
        })->get();
    }
}
