@php
    $modelo     = 'aluno';
    $cadastrar  = 'aluno.criar';
    $editar     = 'aluno.editar';
    $excluir    = 'aluno.excluir';
    $titulo     = 'Aluno';
@endphp

<div class="card">
    <div class="card-header">
        Cadastro Aluno
    </div>
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="form-group col-md-4">
                <label class="mt-3">
                    Nome *
                </label>
                <input id="nome"
                    type="text"
                    class="form-control @error('nome') is-invalid @enderror"
                    name="nome" value="{{old('nome') ?? $Aluno->nome}}"
                    maxlength="256"
                    required
                    >
                @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label class="mt-3">
                    Sobrenome *
                </label>
                <input id="sobrenome"
                    type="text"
                    class="form-control @error('sobrenome') is-invalid @enderror"
                    name="sobrenome" value="{{old('sobrenome') ?? $Aluno->sobrenome}}"
                    maxlength="256"
                    required
                    >
                @error('sobrenome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label class="mt-3">
                    Idade *
                </label>
                <input id="sala"
                    type="number"
                    class="form-control @error('idade') is-invalid @enderror"
                    name="idade" value="{{old('idade') ?? $Aluno->idade}}"
                    required
                    >
                @error('idade')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="mt-3">
                Bolsa de estudos *
            </label>
            <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="bolsa_estudos" {{$Aluno->bolsa_estudos ? 'checked' : ''}} required id="bolsa_estudos_sim" value="1"/>
                <label class="form-check-label" for="bolsa_estudos_sim">Sim</label>
            </div>

            <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="bolsa_estudos" {{!$Aluno->bolsa_estudos ? 'checked' : ''}} required id="bolsa_estudos_nao" value="0"/>
                <label class="form-check-label" for="bolsa_estudos_nao">Não</label>
            </div>
            @error('bolsa_estudos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label class="mt-3">
                Turma * 
            </label>
            <select id="turma_id" class="form-control custom-select @error('turma_id') is-invalid @enderror" name="turma_id" required>
                <option value=""></option>
                @foreach ($ListaTurma as $value)
                    <option value="{{$value->id}}" {{ $value->id == (old('turma_id') ?? $Aluno->turma_id) ? 'selected' : '' }}>
                        {{$value->escola->nome . ' - Equipe: ' . $value->equipe . ', Sala: ' . $value->sala}}
                    </option>
                @endforeach
            </select>
            @error('turma_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>