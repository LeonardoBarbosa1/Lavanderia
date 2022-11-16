<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Exports\ClientesExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::when($request->term, function ($query, $term) {
            $query->where("id_cidades", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("nome", "ILIKE", "%" . $term . "%")
                ->orWhere("cpf_cnpj", "ILIKE", "%" . $term . "%")
                ->orWhere("telefone", "ILIKE", "%" . $term . "%")
                ->orWhere("endereco", "ILIKE", "%" . $term . "%")
                ->orWhere("bairro", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($cliente) {
                return [
                    'id' => $cliente->id,
                    "cidade" => $cliente->cidade->nome,
                    "status" => $cliente::getStatusByID($cliente->status),
                    "nome" => $cliente->nome,
                    "cpf_cnpj" => $cliente->cpf_cnpj,
                    "telefone" => $cliente->telefone,
                    "endereco" => $cliente->endereco,
                    "bairro" => $cliente->bairro,

                ];
            });
        return Inertia::render('Cliente/Index', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = DB::table('cidades')->get();
        $cid = $cidades->toArray();
        $cidades = array_unique($cid, SORT_REGULAR);

        

        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render('Cliente/Create', [
            
            'cidades' => $cidades,
            'status'=>$status
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
            'id_cidades' => 'required',
            'status' => 'required',
            'nome' => 'required',
            'cpf_cnpj' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',

        ]);

        Cliente::create($request->all());
        return Redirect::route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $status=$cliente::getStatusByID($cliente->status);
        $cidade=$cliente->cidade->nome;
        return Inertia::render('Cliente/Show', [
            'cliente' => $cliente,
            'status'=>$status,
            'cidade'=>$cidade,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $cidades = DB::table('cidades')->get();
        $cid = $cidades->toArray();
        $cidades = array_unique($cid, SORT_REGULAR);

        

        $status = array(['id'=> 1,'descricao'=>"ATIVO"],
                        ['id'=>2,'descricao'=>"INATIVO"]);
        $status = array_unique($status, SORT_REGULAR);
        
        return Inertia::render(
            'Cliente/Update',
            [
                'cliente' => $cliente,
                'cidades' => $cidades,
                'status'=>$status
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        return Redirect::route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return Redirect::route('clientes.index');
    }

    public function export(Request $request)
    {
        return (new ClientesExport($request->term))->download('clientes.xlsx');
    }
}
