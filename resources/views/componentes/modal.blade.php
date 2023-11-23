<!-- Modal -->
<div class="modal fade" id="modalEnable" tabindex="-1" role="dialog" aria-labelledby="modalEnableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Atenção!</h5>
                <span aria-hidden="true" aria-label="Close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>
            <form action="#" method="POST" id="modalForm">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <p id="Modal-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>