$(document).ready(function(){
  $('.btn-blocked').click(function(e){
    e.preventDefault();

    var row = $(this).parents('tr');

    var id = row.data('id');

    //alert(id);

    var form = $('#form-block');

    var url = form.attr('action').replace(':USER_ID', id);

    var data = form.serialize();

    //alert(data);

    bootbox.confirm(message, function(res){
      if(res == true)
      {
        $.post(url, data, function(result){
          if(result.blocked == 1)
          {
            row.addClass('row-blocked');
            $('#boton-editar').addClass('disabled');
            $('#boton-eliminar').addClass('disabled');
            $('#boton-bloquear').html('Desbloquear');
            $('#message').removeClass('invisible');
            $('#user-message').text(result.message);

          }
          else
          {
            $('#message-danger').removeClass('invisible');
            $('#user-message-danger').text(result.message);
          }
        }).fail(function(){
          alert('ERROR');
          row.show();
        });
      }
    });
  });
});
