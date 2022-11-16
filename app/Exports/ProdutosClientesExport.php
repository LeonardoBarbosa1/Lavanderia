<?php

namespace App\Exports;

use App\Models\ProdutosCliente;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosClientesExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id','descricao','status','created_at','created_by','updated_at','updated_by','id_clientes'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProdutosCliente::when($this->term, function($query, $term){
            $query->where("descricao","ILIKE","%".$term."%")
	->orWhere("descricao","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("id_clientes","ILIKE","%".$term."%")
	;
        })->get();
    }
}
