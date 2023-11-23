$(function () {
    $('#ativo').on('change', function(){
        if(this.checked){
            $('#ativo').prop('checked',true);
            $('#ativo').val(1);
        }else{
            $('#ativo').prop('checked',false);
            $('#ativo').val(0);
        }
    });
});