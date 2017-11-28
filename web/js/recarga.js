//Actualizar una vez al cargar página
window.onunload = sale
var valor;
var pathname = window.location.pathname;
console.log(pathname);
if(document.cookie){
  console.log(document.cookie);
  galleta = unescape(document.cookie)
  console.log(galleta);
  galleta = galleta.split(';')
  console.log(galleta);
  if(pathname != '/admin/usuarios')
  {
    for(m=0; m<galleta.length; m++){
        console.log(m);
        console.log(galleta.length);
        console.log(galleta[m]);
        console.log(galleta[m].split('=')[0]);
        if(galleta[m].split('=')[0] == "recarga")
        {
          valor = galleta[m].split('=')[1]
          console.log(valor);
          break;
        }
    }
  }
  else if(pathname == '/admin/usuarios')
  {
    //variable que guardara el lugar unico donde se modifica la recarga
    var a = galleta.length-2;
    console.log(a);
    console.log(galleta[a].split('=')[0]);
    if(galleta[a].split('=')[0] == "recarga" || galleta[a].split('=')[0] == " recarga"){
      valor = galleta[a].split('=')[1]
      console.log(valor);
    }
  }

  if(valor == "sip")
  {
    console.log('recargando...');
    console.log(document.cookie);
    document.cookie = "recarga=nop";
    console.log(document.cookie);
    window.onunload = function(){}
    document.location.reload()
  }
  else
  {
    window.onunload=sale
    console.log('se detiene');
  }
}

function sale(){
document.cookie ="recarga=sip";
}
