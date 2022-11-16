<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
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

    protected $fillable = ['status','nome','sigla'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($estado) {
            $estado->nome = strtoupper($estado->nome);
            $estado->sigla = strtoupper($estado->sigla);

        });
    }
    


    

}
