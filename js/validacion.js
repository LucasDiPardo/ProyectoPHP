//debugger;
function validar(){

    let nombre=document.getElementById("inputNombre").value;
    let descripcion=document.getElementById("inputDescripcion").value;
    let imagen=document.getElementById("inputImagen").value;
    let plataforma=document.getElementById("inputPlataforma").value;
    let url=document.getElementById("inputUrl").value;
    let genero=document.getElementById("inputGenero").value;
    

    let completo= nombre!=null 
        && descripcion<=255
        &&imagen!=null
        &&plataforma!=null
        &&url<=80
        &&genero!=null;


    
    if (completo) {
        if (nombre=null){
            
        }
        document.getElementById('mensajeError').style.display='block';
        event.preventDefault();
    }
    
    return completo;
}