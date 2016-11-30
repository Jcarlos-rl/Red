$(document).ready(function(){
  function templateColaborador(id,email, nombre, tituloBoton, style = 'success') {
    var aux = template;
    aux = aux.replace('%id%',id);
    aux = aux.replace('%email%',email);
    aux = aux.replace('%name%',nombre);
    aux = aux.replace('%style%',style);
    aux = aux.replace('%title%',tituloBoton);
    return aux;
  }

  function obtenerUsuarios(idConocimiento) {
    var data = {idProyecto : idProject, id : idConocimiento, _token : token};
    var url = '../proyecto/buscarUsuario';
    $.post(url, data, function(response){
      $.each(response.users, function( index, user ) {
        $('#collaborators').append(templateColaborador(user.id, user.email, user.name, 'agregar'));
      });
    });
  }

  $('#collaboratorText').keyup(function(){
        var user = $(this).val();
        //if (user.length > 1) {
          var data = {name : user, _token : token};
          var url = '../proyecto/buscarConocimiento';

          $.post(url, data, function(response) {
            $( "#collaboratorText" ).autocomplete({
              source: response.conocimientos,
              minLength: 1,
              select: function(event, ui) {
                event.preventDefault();
                $('#collaborators').html('');
                obtenerUsuarios(ui.item.value);
                $('#collaboratorText').val('');
              },
              focus: function(event, ui) {
                event.preventDefault();
              }
            });
          });
        //}
    });

    $('#collaborators').on( "click", "button", function(e) {
        var fila = $(this).parents('tr');
        var id = fila.attr('id');
        var email = $(this).parents('.row').attr('id');
        var nombre = $(this).parent().siblings('.col-md-9').children('span').html();
        if ($('#selectedCollaborators > #'+id).length == 0) {
          $('#selectedCollaborators').append(templateColaborador(id, email, nombre, 'x', 'danger'));
        }
    });

    $('#selectedCollaborators').on( "click", "button", function(e) {
        var fila = $(this).parents('tr').fadeOut(300,function () { $(this).remove()});
        //var id = $(this).parents('div').attr('id');
        //alert($.md5(id));
    });
});
