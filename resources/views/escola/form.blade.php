@php
    $modelo     = 'escola';
    $cadastrar  = 'escola.criar';
    $editar     = 'escola.editar';
    $excluir    = 'escola.excluir';
    $titulo     = 'Escola';

@endphp


<div class="card">
    <div class="card-header">
        Cadastro Escola
    </div>
    <div class="card-body">
        @csrf
        <div class="form-group col-md-12">
            <label class="mt-3">
                Nome *
            </label>
            <input id="nome"
                type="text"
                class="form-control @error('nome') is-invalid @enderror"
                name="nome" value="{{old('nome') ?? $Escola->nome}}"
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
                Segmento *
            </label>
            <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="segmento" id="inlineRadio1" {{$Escola->segmento == 'Ensino Primário' ? 'checked' : ''}} required value="Ensino Primário"/>
                <label class="form-check-label" for="inlineRadio1">Ensino Primário</label>
            </div>

            <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="segmento" id="inlineRadio2" {{$Escola->segmento == 'Ensino Fundamental' ? 'checked' : ''}} required value="Ensino Fundamental"/>
                <label class="form-check-label" for="inlineRadio2">Ensino Fundamental</label>
            </div>

            <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="segmento" id="inlineRadio3" {{$Escola->segmento == 'Ensino Médio' ? 'checked' : ''}} required value="Ensino Médio" />
                <label class="form-check-label" for="inlineRadio3">Ensino Médio</label>
            </div>
            @error('segmento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="mt-3">
                Endereço 
            </label>
            <textarea id="endereco"
                name="endereco" 
                class="form-control @error('endereco') is-invalid @enderror" 
                cols="20" 
                rows="2">{{old('endereco') ?? $Escola->endereco}}</textarea>
            @error('endereco')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label class="mt-3">
                País
            </label>
            <input id="pais"
                type="text"
                class="form-control @error('pais') is-invalid @enderror"
                name="pais" value="{{old('pais') ?? $Escola->pais}}"
                maxlength="256"
                >
            @error('pais')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        <div class="form-group col-md-3">
            <label class="mt-3">
                Quantidade máxima de alunos
            </label>
            <input id="max_alunos"
                type="number"
                class="form-control @error('max_alunos') is-invalid @enderror"
                name="max_alunos" value="{{old('max_alunos') ?? $Escola->max_alunos}}"
                maxlength="256"
                >
            @error('max_alunos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>