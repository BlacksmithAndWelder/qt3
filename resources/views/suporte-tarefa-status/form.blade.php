@php
    $modelo     = 'suporte-tarefa-status';
    $cadastrar  = 'suporte-tarefa-status.criar';
    $editar     = 'suporte-tarefa-status.editar';
    $excluir    = 'suporte-tarefa-status.excluir';
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
                    Nome *
                </label>
                <i class="fa-regular fa-circle-info" title="Nomes disponíveis: 'Aberto', 'Inconsistente', 'Solucionado', 'Recusado'"></i>
                <input id="nome"
                    type="text"
                    class="form-control @error('nome') is-invalid @enderror"
                    name="nome" value="{{old('nome') ?? $SuporteTarefaStatus->nome}}"
                    maxlength="20"
                    required
                    >
                @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>