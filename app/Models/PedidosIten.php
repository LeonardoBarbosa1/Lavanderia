<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class PedidosIten extends Model
{
    const PENDENTE = 1;
    const CONCLUIDA = 2;
    const EXPEDIDA = 3;
    const CANCELADA = 4;

    private static $_status = [
        self::PENDENTE=> 'PENDENTE',
        self::CONCLUIDA=> 'CONCLUIDA',
        self::EXPEDIDA=> 'EXPEDIDA',
        self::CANCELADA=> 'CANCELADA',
    ];
    public static function getStatus()
    {
        return self::$_status;
    }
    public static function getStatusByID($id)
    {
        try {
            if (!empty($id)) {
                return self::$_status[$id];
            }
        } catch (Exception $e) {
            return self::PENDENTE;
        }
    }

    use HasFactory;

    protected $fillable = ['id_pedidos','id_servicos','peso_medio_peca','valor','status','descricao','quantidade','produto_clientes'];

    protected $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedidos');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servicos');
    }
    

}
