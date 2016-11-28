$(document).ready(function(){
  $('.btn-delete').click(function(e){
    e.preventDefault();
    var fila = $(this).parents('tr');
    var id = fila.attr('id');
    var form = $('#form-delete');
    var url = form.attr('action').replace('ID_PROJECT',id);
    var data = form.serialize();
    var nombre = fila.find('#projectName').html();
    //bootbox.alert({message: nombre,size: 'small'});
    bootbox.confirm('¿Estas seguro de eliminar '+nombre+'?', function(res){
      if (res == true) {
        $('#delete-progress').removeClass('hidden');
        $.post(url, data, function(result){
          $('#delete-progress').addClass('hidden');
          fila.fadeOut();
          $('#message').removeClass('hidden');
          $('#text-message').text(result.message);
        }).fail(function(){
          alert('ERROR');
          fila.show();
        });
      }
    });
  });
});
