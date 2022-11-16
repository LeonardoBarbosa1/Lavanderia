<?php

namespace App\Http\Controllers;

use App\Models\ServicosItensValore;
use App\Exports\ServicosItensValoresExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ServicosItensValoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $servicosItensValores = ServicosItensValore::when($request->term, function ($query, $term) {
            $query->where("valor", "ILIKE", "%" . $term . "%")
                ->orWhere("valor", "ILIKE", "%" . $term . "%")
                ->orWhere("id_servicos", "ILIKE", "%" . $term . "%")
                ->orWhere("produto_utilizado", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($servicosItensValore) {
                return [
                    'id' => $servicosItensValore->id,
                    "valor" => $servicosItensValore->valor,
                    "servico" => $servicosItensValore->servico->descricao,
                    "produto_utilizado" => $servicosItensValore->produto_utilizado,

                ];
            });
        return Inertia::render('ServicosItensValore/Index', [
            'servicosItensValores' => $servicosItensValores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicos = DB::table('servicos')->get();
        $serv = $servicos->toArray();
        $servicos = array_unique($serv, SORT_REGULAR);

        return Inertia::render('ServicosItensValore/Create', [
            'servicos' => $servicos,
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
            'valor' => 'required',
            'id_servicos' => 'required',
            'produto_utilizado' => 'required',

        ]);

        ServicosItensValore::create($request->all());
        return Redirect::route('servicos-itens-valores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicosItensValore  $servicosItensValore
     * @return \Illuminate\Http\Response
     */
    public function show(ServicosItensValore $servicosItensValore)
    {

        $servico = $servicosItensValore->servico->descricao;
        return Inertia::render('ServicosItensValore/Show', [
            'servicosItensValore' => $servicosItensValore,
            'servico' => $servico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicosItensValore  $servicosItensValore
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicosItensValore $servicosItensValore)
    {
        $servicos = DB::table('servicos')->get();
        $serv = $servicos->toArray();
        $servicos = array_unique($serv, SORT_REGULAR);

        return Inertia::render(
            'ServicosItensValore/Update',
            [
                'servicosItensValore' => $servicosItensValore,
                'servicos' => $servicos
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicosItensValore  $servicosItensValore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicosItensValore $servicosItensValore)
    {
        $servicosItensValore->update($request->all());
        return Redirect::route('servicos-itens-valores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicosItensValore  $servicosItensValore
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicosItensValore $servicosItensValore)
    {
        $servicosItensValore->delete();
        return Redirect::route('servicos-itens-valores.index');
    }

    public function export(Request $request)
    {
        return (new ServicosItensValoresExport($request->term))->download('servicos-itens-valores.xlsx');
    }
}
