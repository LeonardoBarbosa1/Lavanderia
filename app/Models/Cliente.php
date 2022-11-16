<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    const ATIVO = 1;
    const INATIVO = 2;
    
    private static $_status = [
        self::ATIVO=> 'ATIVO',
        self::INATIVO=> 'INATIVO',
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
            return self::ATIVO;
        }
    } 

    use HasFactory;

    protected $fillable = ['id','id_cidades','status','nome','cpf_cnpj','telefone','endereco','bairro'];
    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'id_cidades');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($cliente) {
            $cliente->nome = strtoupper($cliente->nome);
            $cliente->endereco = strtoupper($cliente->endereco);
            $cliente->bairro = strtoupper($cliente->bairro);
           

        });
    }
   
    

}
