<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Exports\ServicosExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $servicos = Servico::when($request->term, function ($query, $term) {
            $query->where("status", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("descricao", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($servico) {
                return [
                    'id' => $servico->id,
                    "status" => $servico::getStatusByID($servico->status),
                    "descricao" => $servico->descricao,

                ];
            });
        return Inertia::render('Servico/Index', [
            'servicos' => $servicos,
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

        return Inertia::render('Servico/Create', [
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
            'descricao' => 'required',

        ]);

        Servico::create($request->all());
        return Redirect::route('servicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function show(Servico $servico)
    {
        $status=$servico::getStatusByID($servico->status);
        return Inertia::render('Servico/Show', [
            'servico' => $servico,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function edit(Servico $servico)
    {
        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render(
            'Servico/Update',
            [
                'servico' => $servico,
                'status' => $status,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico)
    {
        $servico->update($request->all());
        return Redirect::route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();
        return Redirect::route('servicos.index');
    }

    public function export(Request $request)
    {
        return (new ServicosExport($request->term))->download('servicos.xlsx');
    }
}
