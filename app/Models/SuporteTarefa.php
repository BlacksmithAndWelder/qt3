<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuporteTarefa extends Model
{
    use HasFactory;

    protected $table = 'suporte_tarefas';
    protected $fillable = ['status_id', 'user_id', 'assunto', 'descricao', 'urgente', 'created_at', 'updated_at'];

    public function status(){
        return $this->hasOne(SuporteTarefaStatus::class, 'id', 'status_id');
    }
    public function usuario(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
