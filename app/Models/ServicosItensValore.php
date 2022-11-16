<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicosItensValore extends Model
{
    use HasFactory;

    protected $fillable = ['valor','id_servicos','produto_utilizado'];
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servicos');
    }


    

}
