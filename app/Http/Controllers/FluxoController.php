<?php

namespace App\Http\Controllers;

use App\Models\Fluxo;
use App\Exports\FluxosExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class FluxoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fluxos = Fluxo::when($request->term, function ($query, $term) {
            $query->where("data_saida", "ILIKE", "%" . $term . "%")
                ->orWhere("data_saida", "ILIKE", "%" . $term . "%")
                ->orWhere("data_entrada", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("id_pedidos_itens", "ILIKE", "%" . $term . "%")
                ->orWhere("id_setores", "ILIKE", "%" . $term . "%")
                ->orWhere("quantidade", "ILIKE", "%" . $term . "%")
                ->orWhere("observacao", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($fluxo) {
                return [
                    'id' => $fluxo->id,
                    "data_saida" => date('d/m/Y',strtotime($fluxo->data_saida)),
                    "data_entrada" => date('d/m/Y',strtotime($fluxo->data_entrada)),
                    "status" => $fluxo::getStatusByID($fluxo->status),
                    "pedidosIten" => $fluxo->pedidosIten->id,
                    "setore" => $fluxo->setore->descricao,
                    "quantidade" => $fluxo->quantidade,
                    "observacao" => $fluxo->observacao,

                ];
            });
        return Inertia::render('Fluxo/Index', [
            'fluxos' => $fluxos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedidosItens = DB::table('pedidos_itens')->get();
        $pi = $pedidosItens->toArray();
        $pedidosItens = array_unique($pi, SORT_REGULAR);

        $setores = DB::table('setores')->get();
        $set = $setores->toArray();
        $setores = array_unique($set, SORT_REGULAR);

        $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render('Fluxo/Create', [
            'pedidosItens' => $pedidosItens,
            'setores' => $setores,
            'status' => $status,
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
            'data_saida' => 'required',
            'data_entrada' => 'required',
            'status' => 'required',
            'id_pedidos_itens' => 'required',
            'id_setores' => 'required',
            'quantidade' => 'required',
            'observacao' => 'required',

        ]);

        Fluxo::create($request->all());
        return Redirect::route('fluxos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fluxo  $fluxo
     * @return \Illuminate\Http\Response
     */
    public function show(Fluxo $fluxo)
    {
        $status=$fluxo::getStatusByID($fluxo->status);
        $setore=$fluxo->setore->descricao;
        $pedidosIten=$fluxo->pedidosIten->id;

        return Inertia::render('Fluxo/Show', [
            'fluxo' => $fluxo,
            'pedidosIten' => $pedidosIten,
            'setore' => $setore,
            'status' => $status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fluxo  $fluxo
     * @return \Illuminate\Http\Response
     */
    public function edit(Fluxo $fluxo)
    {
        $pedidosItens = DB::table('pedidos_itens')->get();
        $pi = $pedidosItens->toArray();
        $pedidosItens = array_unique($pi, SORT_REGULAR);

        $setores = DB::table('setores')->get();
        $set = $setores->toArray();
        $setores = array_unique($set, SORT_REGULAR);

        $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render(
            'Fluxo/Update',
            [
                'fluxo' => $fluxo,
                'pedidosItens' => $pedidosItens,
                'setores' => $setores,
                'status' => $status,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fluxo  $fluxo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fluxo $fluxo)
    {
        $fluxo->update($request->all());
        return Redirect::route('fluxos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fluxo  $fluxo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fluxo $fluxo)
    {
        $fluxo->delete();
        return Redirect::route('fluxos.index');
    }

    public function export(Request $request)
    {
        return (new FluxosExport($request->term))->download('fluxos.xlsx');
    }
}
