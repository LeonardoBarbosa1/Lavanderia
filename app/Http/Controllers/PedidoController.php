<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Exports\PedidosExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;



class PedidoController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::when($request->term, function ($query, $term) {

            $query->where("id", "ILIKE", "%" . $term . "%")
                ->orWhere("situacao", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("data_pedido", "ILIKE", "%" . $term . "%")
                ->orWhere("id_clientes", "ILIKE", "%" . $term . "%")
                ->orWhere("descricao", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($pedido) {
               
                return [
                    'id' => $pedido->id,
                    //"situacao" => $pedido->situacao,
                    "situacao" => $pedido::getSituacaoByID($pedido->situacao),
                    "status" => $pedido::getStatusByID($pedido->status),
                    "data_pedido" => date('d/m/Y',strtotime($pedido->data_pedido)),
                    "cliente" => $pedido->cliente->nome,
                    "descricao" => $pedido->descricao,

                ];
                
                
            });
            
        return Inertia::render('Pedido/Index', [
            'pedidos' => $pedidos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = DB::table('clientes')->get();
        $clt = $clientes->toArray();
        $clientes = array_unique($clt, SORT_REGULAR);

        $situacao = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $situacao = array_unique($situacao, SORT_REGULAR);

        $status = array(['id'=> 2,'descricao'=>"PEDIDO"],
                        ['id'=>1,'descricao'=>"ORÇAMENTO"]);
        $status = array_unique($status, SORT_REGULAR);
        
        
        return Inertia::render('Pedido/Create', [

            'clientes' => $clientes,
            'situacao' => $situacao,
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
            
            'situacao' => 'required',
            'status' => 'required',
            'data_pedido' => 'required',
            'id_clientes' => 'required',
            'descricao' => 'required',

        ]);
        //function getProvince($request)
        //{
        //    return strtoupper($request->descricao);
        //};
        //Pode ser feito desta forma tambem
        //$pedido=new Pedido();  
        //$pedido->situacao = $request->input('situacao');
        //$pedido->status = $request->input('status');
        //$pedido->data_pedido = $request->input('data_pedido');
        //$pedido->id_clientes = $request->input('id_clientes');
        //$pedido->descricao = $request->input('descricao');
        //$pedido->save();

        //dd($p);
        Pedido::create($request->all());
        return Redirect::route('pedidos.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        
        $situacao=$pedido::getSituacaoByID($pedido->situacao);
        $status=$pedido::getStatusByID($pedido->status);
        $cliente=$pedido->cliente->nome;
        
        return Inertia::render('Pedido/Show', [
            'pedido' => $pedido,
            'situacao' => $situacao,
            'status' => $status,
            'cliente'=> $cliente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        $clientes = DB::table('clientes')->get();
        $clt = $clientes->toArray();
        $clientes = array_unique($clt, SORT_REGULAR);
        
        $situacao = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $situacao = array_unique($situacao, SORT_REGULAR);

        $status = array(['id'=> 2,'descricao'=>"PEDIDO"],
                        ['id'=>1,'descricao'=>"ORÇAMENTO"]);
        $status = array_unique($status, SORT_REGULAR);


        return Inertia::render(
            'Pedido/Update',
            [
                'pedido' => $pedido,
                'situacao' => $situacao,
                'status' => $status,
                'clientes'=> $clientes
                
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update($request->all());
        return Redirect::route('pedidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return Redirect::route('pedidos.index');
    }

    public function export(Request $request)
    {
        return (new PedidosExport($request->term))->download('pedidos.xlsx');
    }
}
