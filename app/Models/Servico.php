<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Servico extends Model
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

    protected $fillable = ['status','descricao'];
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($servico) {
            $servico->descricao = strtoupper($servico->descricao);
           

        });
    }
    

}
