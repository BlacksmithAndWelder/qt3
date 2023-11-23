@if (isset($editar) && $editar)
    <a 
        href="{{ route($editar, ['id' => $id ]) }}" 
        style="width: auto; !important"
        class="btn btn-sm mr-1 btn-outline-primary" 
        data-placement="top"
        data-toggle="tooltip" 
        title="Editar">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endif

@if (isset($excluir) && $excluir)
    <button type="button"
        class="btn btn-sm mr-1 btn-outline-danger"
        style="width: auto; !important"
        title="Excluir"
        data-cattext="Tem certeza que deseja realizar a exclusão?"
        data-catid="{{route($excluir, $id)}}"
        data-placement="top"
        data-bs-toggle="modal"
        data-bs-target="#modalEnable">
        <i class="fa-solid fa-trash-can"></i>
    </button>
@endif

@if (isset($ativo))
    @if ($ativo)
        <button type="button"
            class="btn btn-sm mr-1 btn-outline-secondary"
            style="width: auto; !important"
            title="Desativar"
            data-cattext="Tem certeza que deseja realizar a inativação?"
            data-catid="{{route($desativar, $id)}}"
            data-placement="top"
            data-bs-toggle="modal"
            data-bs-target="#modalEnable">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
    @else
        <button type="button"
            class="btn btn-sm mr-1 btn-outline-success"
            style="width: auto; !important"
            title="Ativar"
            data-cattext="Tem certeza que deseja realizar a ativação?"
            data-catid="{{route($ativar, $id)}}"
            data-placement="top"
            data-bs-toggle="modal"
            data-bs-target="#modalEnable">
            <i class="fa-solid fa-circle-check"></i>
        </button>
    @endif
    
@endif