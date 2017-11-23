$(document).ready(function(){
  $('.btn-delete').click(function(e){
    e.preventDefault();

    var row = $(this).parents('tr');

    var id = row.data('id');

    //alert(id);

    var form = $('#form-delete');

    var url = form.attr('action').replace(':USER_ID', id);

    var data = form.serialize();

    //alert(data);

    bootbox.confirm('¿Esta seguro que desea eliminar este usuario?', function(res){
      if(res == true)
      {
        $.post(url, data, function(result){
          if(result.removed == 1)
          {
            row.fadeOut();
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

        var delay = 3000;

        setTimeout(function(){
          location.reload();
        }, delay);
        
      }
    });
  });
});
