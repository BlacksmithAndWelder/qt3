@php
    $modelo     = 'turma';
    $cadastrar  = 'turma.criar';
    $editar     = 'turma.editar';
    $excluir    = 'turma.excluir';
    $titulo     = 'Turma';
@endphp

<div class="card">
    <div class="card-header">
        Cadastro Turma
    </div>
    <div class="card-body">
        @csrf
            <div class="form-group col-md-4">
                <label class="mt-3">
                    Escola *
                </label>
                <select id="escola_id" class="form-control custom-select @error('escola_id') is-invalid @enderror" name="escola_id" required>
                    <option value=""></option>
                    @foreach ($ListaEscolas as $value)
                        <option value="{{$value->id}}" {{ $value->id == (old('escola_id') ?? $Turma->escola_id) ? 'selected' : '' }}>{{$value->nome}}</option>
                    @endforeach
                </select>
                @error('escola_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        <div class="form-group col-md-4">
            <label class="mt-3">
                Ativo 
            </label>
            <select id="ativo" class="form-control custom-select @error('ativo') is-invalid @enderror" name="ativo" required>
                <option value="1" {{$Turma->ativo ? 'selected' : ''}}>Sim</option>
                <option value="0" {{!$Turma->ativo ? 'selected' : ''}}>Não</option>
            </select>
            @error('ativo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label class="mt-3">
                    Equipe *
                    <i class="fa-regular fa-circle-info" title="Equipes disponíveis: A, B, C, D"></i>
                </label>
                <input id="equipe"
                    type="text"
                    class="form-control @error('equipe') is-invalid @enderror"
                    name="equipe" value="{{old('equipe') ?? $Turma->equipe}}"
                    maxlength="1"
                    required
                    >
                @error('equipe')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="mt-3">
                    Sala *
                </label>
                <i class="fa-regular fa-circle-info" title="Salas disponíveis: 1, 2, 3, 4"></i>
                <input id="sala"
                    type="number"
                    class="form-control @error('sala') is-invalid @enderror"
                    name="sala" value="{{old('sala') ?? $Turma->sala}}"
                    min="1" max="4"
                    required
                    >
                @error('sala')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>