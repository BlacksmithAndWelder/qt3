@php
    $modelo     = 'usuario';
    $cadastrar  = 'usuario.criar';
    $editar     = 'usuario.editar';
    $excluir    = 'usuario.excluir';
    $titulo     = 'Usuário';
@endphp

<div class="card">
    <div class="card-header">
        Cadastro Usuário
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
                    name="nome" value="{{old('nome') ?? $Usuario->name}}"
                    maxlength="20"
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
                    Senha *
                </label>
                <input id="senha"
                    type="password"
                    class="form-control @error('senha') is-invalid @enderror"
                    name="senha"
                    required
                    >
                @error('senha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="mt-3">
                Email *
            </label>
            <input id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{old('email') ?? $Usuario->email}}"
                required
                >
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>