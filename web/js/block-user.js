$(document).ready(function(){
  $('.btn-blocked').click(function(e){
    e.preventDefault();

    var row = $(this).parents('tr');

    console.log(row);


    var sameline = $(this).siblings('a');

    console.log(sameline);

    var thisbutton = $(this);

    console.log(thisbutton);
    //elemneto actual asignado a una varaible para aplicar objeto text

    var id = row.data('id');


    //alert(id);
    //Datos para bloquear
    var form = $('#form-block');

    var url = form.attr('action').replace(':USER_ID', id);

    var data = form.serialize();


    //alert(data);

    bootbox.confirm('¿Esta seguro que desea bloquear este usuario?', function(res){
      if(res == true)
      {
        $.post(url, data, function(result){
          if(result.blocked == 1)
          {
            row.addClass('row-blocked');
            sameline.addClass('disabled');
            thisbutton.text("Desbloquear");
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
