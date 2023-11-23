<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuporteTarefaStatus extends Model
{
    use HasFactory;

    protected $table = 'suporte_tarefa_status';
    protected $fillable = ['nome'];

    public function suporteTarefas(){
        return $this->hasMany(SuporteTarefa::class, 'status_id', 'id');
    }
}
