<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{


    const PENDENTE = 1;
    const CONCLUIDA = 2;
    const EXPEDIDA = 3;
    const CANCELADA = 4;

    private static $_situacao = [
        self::PENDENTE=> 'PENDENTE',
        self::CONCLUIDA=> 'CONCLUIDA',
        self::EXPEDIDA=> 'EXPEDIDA',
        self::CANCELADA=> 'CANCELADA',
    ];
    public static function getSituacoes()
    {
        return self::$_situacao;
    }
    public static function getSituacaoByID($id)
    {
        try {
            if (!empty($id)) {
                return self::$_situacao[$id];
            }
        } catch (Exception $e) {
            return self::PENDENTE;
        }
    }

    const ORCAMENTO = 1;
    const PEDIDO = 2;

    private static $_status = [
        self::PEDIDO=> 'PEDIDO',
        self::ORCAMENTO=> 'ORÇAMENTO',
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
            return self::ORCAMENTO;
        }
    }


    use HasFactory;


    protected $fillable = ['id','situacao','status','data_pedido','descricao','id_clientes'];

    protected $situacao = array(['id'=> 0,'descricao'=>'PENDENTE'],
                        ['id'=>1,'descricao'=>'CONCLUIDO'],
                        ['id'=>2,'descricao'=>'EXPEDIDO'],
                        ['id'=>3,'descricao'=>'CANCELADO']);
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_clientes');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($pedido) {
            $pedido->descricao = strtoupper($pedido->descricao);

        });
    }


}
