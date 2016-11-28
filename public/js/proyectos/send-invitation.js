$(document).ready(function(){
  $('#btnSend').click(function () {
    var correos = new Array();
    $('#collaborators div').each(function (index) {
      var id = $(this).attr('id');
      correos.push(id);
    });
    var data = {emails : correos, _token : token}
    var url = '../proyecto/enviarCorreos';
    $.post(url, data, function(result){
      alert(result);
    }).fail(function(){
      alert('ERROR');
    });
  });
});
