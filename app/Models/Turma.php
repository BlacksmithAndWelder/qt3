<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';
    protected $fillable = ['escola_id', 'ativo', 'equipe', 'sala'];

    public function escola(){
        return $this->hasOne(Escola::class,'id','escola_id');
    }
}
