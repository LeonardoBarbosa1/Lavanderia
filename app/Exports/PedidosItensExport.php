<?php

namespace App\Exports;

use App\Models\PedidosIten;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosItensExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id','id_pedidos','id_servicos','peso_medio_peca','valor','status','created_at','created_by','updated_at','updated_by','descricao','quantidade','produto_clientes'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PedidosIten::when($this->term, function($query, $term){
            $query->where("id_pedidos","ILIKE","%".$term."%")
	->orWhere("id_pedidos","ILIKE","%".$term."%")
	->orWhere("id_servicos","ILIKE","%".$term."%")
	->orWhere("peso_medio_peca","ILIKE","%".$term."%")
	->orWhere("valor","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("descricao","ILIKE","%".$term."%")
	->orWhere("quantidade","ILIKE","%".$term."%")
	->orWhere("produto_clientes","ILIKE","%".$term."%")
	;
        })->get();
    }
}
