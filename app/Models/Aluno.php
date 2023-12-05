<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';
    protected $fillable = ['nome', 'sobrenome', 'idade', 'bolsa_estudos', 'turma_id'];

    public function turma(){
        return $this->hasOne(Turma::class,'id','turma_id');
    }
}
