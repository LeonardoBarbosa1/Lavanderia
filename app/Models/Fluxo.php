<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fluxo extends Model

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

    protected $fillable = ['data_saida','data_entrada','status','id_pedidos_itens','id_setores','quantidade','observacao'];

    protected $status = array(['id'=> 1,'descricao'=>'PENDENTE'],
                        ['id'=>2,'descricao'=>'CONCLUIDO'],
                        ['id'=>3,'descricao'=>'EXPEDIDO'],
                        ['id'=>4,'descricao'=>'CANCELADO']);
    public function setore()
    {
        return $this->belongsTo(Setore::class, 'id_setores');
    }

    public function pedidosIten()
    {
        return $this->belongsTo(PedidosIten::class, 'id_pedidos_itens');
    }



}
