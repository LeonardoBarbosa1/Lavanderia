<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Exports\CidadesExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cidades = Cidade::when($request->term, function ($query, $term) {
            $query->where("id_estados", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("nome", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($cidade) {
                return [
                    'id' => $cidade->id,
                    "nome" => $cidade->nome,
                    "estado" => $cidade->estado->sigla,
                    "status" => $cidade::getStatusByID($cidade->status),
                ];
            });
            
        return Inertia::render('Cidade/Index', [
            'cidades' => $cidades,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $estados = DB::table('estados')->get();
        $est = $estados->toArray();
        $estados = array_unique($est, SORT_REGULAR);

        

        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

       
        return Inertia::render('Cidade/Create', [

            'estados' => $estados,
            'status' => $status

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_estados' => 'required',
            'status' => 'required',
            'nome' => 'required',

        ]);

        Cidade::create($request->all());
        return Redirect::route('cidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function show(Cidade $cidade)
    {
        $status=$cidade::getStatusByID($cidade->status);
        $estado=$cidade->estado->sigla;
        return Inertia::render('Cidade/Show', [
            'cidade' => $cidade,
            'status' => $status,
            'estado' => $estado,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Cidade $cidade)
    {
        $estados = DB::table('estados')->get();
        $est = $estados->toArray();
        $estados = array_unique($est, SORT_REGULAR);

        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);
        
        return Inertia::render(
            'Cidade/Update',
            [
                'cidade' => $cidade,
                'estados' => $estados,
                'status' => $status
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cidade $cidade)
    {
        $cidade->update($request->all());
        return Redirect::route('cidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cidade $cidade)
    {
        $cidade->delete();
        return Redirect::route('cidades.index');
    }

    public function export(Request $request)
    {
        return (new CidadesExport($request->term))->download('cidades.xlsx');
    }
}
