$(document).ready(function(){
  $('#btnSend').click(function () {
    var idsUser = new Array();
    $('#selectedCollaborators tr').each(function (index) {
      var id = $(this).attr('id');
      idsUser.push(id);
    });
    if (idsUser.length !== 0) {
      var data = {idProyecto : idProject, idsUsuarios : idsUser, _token : token}
      var url = '../proyecto/enviarCorreos';
      $.post(url, data, function(result){
        bootbox.alert(result, function () {
          location.reload();
        });        
      }).fail(function(){
        alert('ERROR');
      });
    }
    else {
      bootbox.alert("No hay colaboradores en la lista.");
    }
  });
});
