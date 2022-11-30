<?php
use App\Http\Controllers\ServicosItensValoreController;
use App\Http\Controllers\ProgramacaoItenController;

use App\Http\Controllers\SetoreController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\FluxoController;
use App\Http\Controllers\TabelaPrecoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\PedidosItenController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutosClienteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function(){
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::get('cidades/export/' , 'App\Http\Controllers\CidadeController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('cidades.export');

Route::resource('cidades', CidadeController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('clientes/export/' , 'App\Http\Controllers\ClienteController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('clientes.export');

Route::resource('clientes', ClienteController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('estados/export/' , 'App\Http\Controllers\EstadoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('estados.export');

Route::resource('estados', EstadoController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('fluxos/export/' , 'App\Http\Controllers\FluxoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('fluxos.export');

Route::resource('fluxos', FluxoController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('pedidos/export/' , 'App\Http\Controllers\PedidoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('pedidos.export');

Route::resource('pedidos', PedidoController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('pedidos-itens/export/' , 'App\Http\Controllers\PedidosItenController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('pedidos-itens.export');

/*Route::get('pedidos-itens/{id}' , 'App\Http\Controllers\PedidosItenController@index')
        ->middleware(['auth:sanctum', 'verified'])->name('pedidos-itens.index'); */       

Route::resource('pedidos-itens', PedidosItenController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('pedidos-itens/index/{id}' , 'App\Http\Controllers\PedidosItenController@index')
->middleware(['auth:sanctum', 'verified'])->name('pedidos-item');

Route::get('pedidos-itens/create/{id}' , 'App\Http\Controllers\PedidosItenController@create')
->middleware(['auth:sanctum', 'verified'])->name('pedidos-item-create');

Route::get('pedidos-itens/store/{id}' , 'App\Http\Controllers\PedidosItenController@store')
->middleware(['auth:sanctum', 'verified'])->name('pedidos-item-store');

Route::get('produtos-clientes/export/' , 'App\Http\Controllers\ProdutosClienteController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('produtos-clientes.export');

Route::resource('produtos-clientes', ProdutosClienteController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('servicos/export/' , 'App\Http\Controllers\ServicoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('servicos.export');

Route::resource('servicos', ServicoController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('setores/export/' , 'App\Http\Controllers\SetoreController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('setores.export');

Route::resource('setores', SetoreController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('tabela-precos/export/' , 'App\Http\Controllers\TabelaPrecoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('tabela-precos.export');

Route::resource('tabela-precos', TabelaPrecoController::class)
        ->middleware(['auth:sanctum', 'verified']);



Route::get('programacao-itens/export/' , 'App\Http\Controllers\ProgramacaoItenController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('programacao-itens.export');

Route::resource('programacao-itens', ProgramacaoItenController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('servicos-itens-valores/export/' , 'App\Http\Controllers\ServicosItensValoreController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('servicos-itens-valores.export');

Route::resource('servicos-itens-valores', ServicosItensValoreController::class)
        ->middleware(['auth:sanctum', 'verified']);

Route::get('fluxo/export/' , 'App\Http\Controllers\FluxoController@export')
        ->middleware(['auth:sanctum', 'verified'])->name('fluxo.export');

Route::resource('fluxo', FluxoController::class)
        ->middleware(['auth:sanctum', 'verified']);
