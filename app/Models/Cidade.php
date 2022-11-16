<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
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

    protected $fillable = ['id','id_estados','status','nome'];
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estados');
    }
    
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($cidade) {
            $cidade->nome = strtoupper($cidade->nome);
           

        });
    }


    

}
