$(document).ready(function(){
  function templateColaborador(email, nombre) {
    var aux = template;
    var hash = md5(email);
    aux = aux.replace('%id%',hash);
    aux = aux.replace('%email%',email);
    aux = aux.replace('%name%',nombre);
    return aux;
  }

  $('#collaboratorText').keyup(function(){
        var user = $(this).val();
        if (user.length > 2) {
          var data = {name : user, _token : token};
          var url = '../proyecto/buscarUsuario';

          $.post(url, data, function(response) {
            $( "#collaboratorText" ).autocomplete({
              source: response.users,
              minLength: 3,
              select: function(event, ui) {
                event.preventDefault();
                var hash = md5(ui.item.value);
                if ($('#'+hash).length == 0) {
                    $('#collaborators').append(templateColaborador(ui.item.value, ui.item.label));
                }
                $('#collaboratorText').val('');
              },
              focus: function(event, ui) {
                event.preventDefault();
              }
            });
          });
        }
    });

    $('#collaborators').on( "click", "button", function(e) {
        var fila = $(this).parents('tr').fadeOut();
        //var id = $(this).parents('div').attr('id');
        //alert($.md5(id));
    });
});
