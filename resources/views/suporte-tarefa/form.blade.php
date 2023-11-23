@php
    $modelo     = 'aluno';
    $cadastrar  = 'aluno.criar';
    $editar     = 'aluno.editar';
    $excluir    = 'aluno.excluir';
    $titulo     = 'Suporte Tarefa Status';
@endphp

<div class="card">
    <div class="card-header">
        Cadastro Suporte Tarefa Status
    </div>
    <div class="card-body">
        @csrf
        <div class="row">
        <div class="form-group col-md-4">
            <label class="mt-3">
                Usuario *
            </label>
            <select id="user_id" class="form-control custom-select @error('user_id') is-invalid @enderror" name="user_id" required>
                <option value=""></option>
                @foreach ($ListaUsuarios as $value)
                    <option value="{{$value->id}}" {{ $value->id == (old('user_id') ?? $SuporteTarefa->user_id) ? 'selected' : '' }}>{{$value->name}}</option>
                @endforeach
            </select>
            @error('status_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label class="mt-3">
                    Status *
                </label>
                <select id="status_id" class="form-control custom-select @error('status_id') is-invalid @enderror" name="status_id" required>
                    <option value=""></option>
                    @foreach ($ListaSuporteTarefaStatus as $value)
                        <option value="{{$value->id}}" {{ $value->id == (old('status_id') ?? $SuporteTarefa->status_id) ? 'selected' : '' }}>{{$value->nome}}</option>
                    @endforeach
                </select>
                @error('status_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                <label class="mt-3">
                    Urgente *
                </label>
                <div class="form-check form-check   ">
                    <input class="form-check-input" type="radio" name="urgente" id="urgenteSim" {{$SuporteTarefa->urgente ? 'checked' : ''}} required value="1"/>
                    <label class="form-check-label" for="urgenteSim">Sim</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="radio" name="urgente" id="urgenteNao" {{!$SuporteTarefa->urgente ? 'checked' : ''}} required value="0"/>
                    <label class="form-check-label" for="urgenteNao">Não</label>
                </div>
                @error('urgente')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                <label class="mt-3">
                    Data de Cadastro
                </label>
                <input id="created_at"
                    type="datetime-local"
                    class="form-control @error('created_at') is-invalid @enderror"
                    name="created_at" disabled value="{{$SuporteTarefa->created_at}}"
                    
                    >
                @error('created_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                <label class="mt-3">
                    Data de Alteração
                </label>
                <input id="updated_at"
                    type="datetime-local"
                    class="form-control  @error('updated_at') is-invalid @enderror"
                    name="updated_at" disabled value="{{old('updated_at') ?? $SuporteTarefa->updated_at}}"
                    readonly
                    >
                @error('updated_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="mt-3">
                Assunto *
            </label>
            <input id="assunto"
                type="text"
                class="form-control @error('assunto') is-invalid @enderror"
                name="assunto" value="{{old('assunto') ?? $SuporteTarefa->assunto}}"
                maxlength="30"
                required
                >
            @error('assunto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label class="mt-3">
                Descrição * 
            </label>
            <textarea id="descricao"
                name="descricao" 
                class="form-control @error('descricao') is-invalid @enderror" 
                cols="20" 
                rows="2"
                required>{{old('descricao') ?? $SuporteTarefa->descricao}}</textarea>
            @error('descricao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>