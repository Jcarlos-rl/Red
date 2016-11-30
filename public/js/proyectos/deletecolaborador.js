$(document).ready(function(){
  $('.btn-delete').click(function(e){
    e.preventDefault();
    var fila = $(this).parents('tr');
    var id = fila.attr('id');
    var form = $('#form-delete');
    var url = form.attr('action').replace('ID_COLABORADOR',id);
    var data = form.serialize();
    bootbox.confirm('¿Estas seguro de eliminar?', function(res){
      if (res == true) {
        $.post(url, data, function(result){
          fila.fadeOut(300,function () { $(this).remove()});
        }).fail(function(){
          alert('ERROR');
          fila.show();
        });
      }
    });
  });
});
