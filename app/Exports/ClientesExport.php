<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id_cidades','created_at','created_by','updated_at','updated_by','id','status','nome','cpf_cnpj','telefone','endereco','bairro'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cliente::when($this->term, function($query, $term){
            $query->where("id_cidades","ILIKE","%".$term."%")
	->orWhere("id_cidades","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("status","ILIKE","%".$term."%")
	->orWhere("nome","ILIKE","%".$term."%")
	->orWhere("cpf_cnpj","ILIKE","%".$term."%")
	->orWhere("telefone","ILIKE","%".$term."%")
	->orWhere("endereco","ILIKE","%".$term."%")
	->orWhere("bairro","ILIKE","%".$term."%")
	;
        })->get();
    }
}
