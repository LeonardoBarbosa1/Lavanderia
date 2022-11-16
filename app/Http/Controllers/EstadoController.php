<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Exports\EstadosExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estados = Estado::when($request->term, function ($query, $term) {
            $query->Where("status", "ILIKE", "%" . $term . "%")
                ->orWhere("nome", "ILIKE", "%" . $term . "%")
                ->orWhere("sigla", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($estado) {
                return [
                    'id' => $estado->id,
                    "status" => $estado::getStatusByID($estado->status),
                    "nome" => $estado->nome,
                    "sigla" => $estado->sigla,

                ];
            });
        return Inertia::render('Estado/Index', [
            'estados' => $estados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render('Estado/Create', [
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
            
            'status' => 'required',
            'nome' => 'required',
            'sigla' => 'required',

        ]);

        Estado::create($request->all());
        return Redirect::route('estados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        $status=$estado::getStatusByID($estado->status);
        return Inertia::render('Estado/Show', [
            'estado' => $estado,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render(
            'Estado/Update',
            [
                'estado' => $estado,
                'status' => $status
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        $estado->update($request->all());
        return Redirect::route('estados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        $estado->delete();
        return Redirect::route('estados.index');
    }

    public function export(Request $request)
    {
        return (new EstadosExport($request->term))->download('estados.xlsx');
    }
}
