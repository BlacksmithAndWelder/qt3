$(function () {
    $('#modalEnable').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const cat_id = button.data('catid');
        const cat_name = button.data('cattext');
        const modal = $(this);

        modal.find('#modalForm').attr('action', cat_id);
        modal.find('.modal-body #Modal-text').html(cat_name);
    });
});
