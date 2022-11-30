<?php

namespace App\Http\Controllers;

use App\Models\PedidosIten;
use App\Exports\PedidosItensExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class PedidosItenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
       
        $id=intval($id);
        
        $pedido=DB::table('pedidos')
        ->select('*')
        ->where('id', '=', $id)
        //->groupBy('status')
        ->get();

        $p=$pedido->toArray();

        //dd($p[0]->id_clientes);
        $cliente=DB::table('clientes')
        ->select('*')
        ->where('id', '=',$p[0]->id_clientes)
        //->groupBy('status')
        ->get();
        


        
        

        $pedidosItens = DB::table('pedidos_itens')
             ->select('*')
             ->where('id_pedidos', '=', $id)
             //->groupBy('status')
             ->paginate(10);
             

       /*$pedidosItens = PedidosIten::when( $request->term, function ($query, $term) {
            $query->where("id_pedidos", "ILIKE", "%" . $term . "%")
                ->orWhere("id_pedidos", "ILIKE", "%" . $term . "%")
                ->orWhere("id_servicos", "ILIKE", "%" . $term . "%")
                ->orWhere("peso_medio_peca", "ILIKE", "%" . $term . "%")
                ->orWhere("valor", "ILIKE", "%" . $term . "%")
                ->orWhere("status", "ILIKE", "%" . $term . "%")
                ->orWhere("descricao", "ILIKE", "%" . $term . "%")
                ->orWhere("quantidade", "ILIKE", "%" . $term . "%")
                ->orWhere("produto_clientes", "ILIKE", "%" . $term . "%");
        })->paginate(10)
            ->through(function ($pedidosIten) {
                return [
                    'id' => $pedidosIten->id,
                    "pedido" => $pedidosIten->pedido->id,
                    "servico" => $pedidosIten->servico->descricao,
                    "peso_medio_peca" => $pedidosIten->peso_medio_peca,
                    "valor" => $pedidosIten->valor,
                    "status" => $pedidosIten::getStatusByID($pedidosIten->status),
                    "descricao" => $pedidosIten->descricao,
                    "quantidade" => $pedidosIten->quantidade,
                    "produto_clientes" => $pedidosIten->produto_clientes,

                ];
            });*/
        return Inertia::render('PedidosIten/Index', [
            'pedidosItens' => $pedidosItens,
            'pedido' => $pedido,
            "cliente" => $cliente,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        
        $id=intval($id);
        
        $pedido=DB::table('pedidos')
        ->select('*')
        ->where('id', '=', $id)
        //->groupBy('status')
        ->get();
        
        /*$pedidos = DB::table('pedidos')->get();
        $ped = $pedidos->toArray();
        $pedidos = array_unique($ped, SORT_REGULAR);*/

        $servicos = DB::table('servicos')->get();
        $serv = $servicos->toArray();
        $servicos = array_unique($serv, SORT_REGULAR);


        $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render('PedidosIten/Create', [

            'pedido' => $pedido,
            'servicos' => $servicos,
            'status' => $status,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $id=intval($id);
        
        $pedido=DB::table('pedidos')
        ->select('*')
        ->where('id', '=', $id)
        //->groupBy('status')
        ->get();
        
        
       
        
      
        $request->validate([
            
            'id_servicos' => 'required',
            'peso_medio_peca' => 'required',
            'valor' => 'required',
            'status' => 'required',
            'descricao' => 'required',
            'quantidade' => 'required',
            'produto_clientes' => 'required',

        ]);
        $pedidoItem=new PedidosItens();
        $pedidoItem->id_pedidos=$id;
        dd($pedidoItem);
        PedidosIten::create($request->all());
        return Redirect::route('pedidos-item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PedidosIten  $pedidosIten
     * @return \Illuminate\Http\Response
     */
    public function show(PedidosIten $pedidosIten)
    {
        $pedido=$pedidosIten->pedido->id;
        $servico=$pedidosIten->servico->descricao;
        $status= $pedidosIten::getStatusByID($pedidosIten->status);

        return Inertia::render('PedidosIten/Show', [
            'pedidosIten' => $pedidosIten,
            'pedido' => $pedido,
            'servico' => $servico,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PedidosIten  $pedidosIten
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidosIten $pedidosIten)
    {
        /*$pedidos = DB::table('pedidos')->get();
        $ped = $pedidos->toArray();
        $pedidos = array_unique($ped, SORT_REGULAR);*/

        $servicos = DB::table('servicos')->get();
        $serv = $servicos->toArray();
        $servicos = array_unique($serv, SORT_REGULAR);


        $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
        $status = array_unique($status, SORT_REGULAR);

        return Inertia::render(
            'PedidosIten/Update',
            [
                'pedidosIten' => $pedidosIten,
                /*'pedidos' => $pedidos,*/
                'servicos' => $servicos,
                'status' => $status
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PedidosIten  $pedidosIten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidosIten $pedidosIten)
    {
        $pedidosIten->update($request->all());
        return Redirect::route('pedidos-itens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidosIten  $pedidosIten
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidosIten $pedidosIten)
    {
        $pedidosIten->delete();
        return Redirect::route('pedidos-itens.index');
    }

    public function export(Request $request)
    {
        return (new PedidosItensExport($request->term))->download('pedidos-itens.xlsx');
    }
}
