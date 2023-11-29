$(function () {
    $('#modalEnable').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var cat_id = button.data('catid');
        var cat_name = button.data('cattext');
        var modal = $(this);

        modal.find('#modalForm').attr('action', cat_id);
        modal.find('.modal-body #Modal-text').html(cat_name);
    });
});