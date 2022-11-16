<?php

namespace App\Exports;

use App\Models\ServicosItensValore;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicosItensValoresExport implements FromCollection, WithHeadings
{

    use Exportable;

    private $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function headings(): array
    {
        return ['id','valor','created_at','created_by','updated_at','updated_by','id_servicos','produto_utilizado'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ServicosItensValore::when($this->term, function($query, $term){
            $query->where("valor","ILIKE","%".$term."%")
	->orWhere("valor","ILIKE","%".$term."%")
	->orWhere("created_by","ILIKE","%".$term."%")
	->orWhere("updated_by","ILIKE","%".$term."%")
	->orWhere("id_servicos","ILIKE","%".$term."%")
	->orWhere("produto_utilizado","ILIKE","%".$term."%")
	;
        })->get();
    }
}
