document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('enviarForm').addEventListener('click', function(e) {
        e.preventDefault();
        if(validar()){
            document.getElementById('formularioCarga').submit();
        }
    })
  })
  
function validar(){
    let valido = true;

    let nombre=document.getElementById("inputNombre").value;
    let descripcion=document.getElementById("inputDescripcion").value;
    let imagen=document.getElementById("inputImagen");
    let plataforma=document.getElementById("inputPlataforma").value;
    let url=document.getElementById("inputUrl").value;
    let genero=document.getElementById("inputGenero").value;
        
        if (nombre=='') {
            document.getElementById('obligatorioNombre').style.display='inline';
            valido=false;
        }else{
            document.getElementById('obligatorioNombre').style.display='none';
        }
        
        //valido max 250 caracteres, puede estar vacio
        if ((descripcion.length>250)||(descripcion=='')){            
            document.getElementById('obligatorioDescripcion').style.display='inline';
            valido=false;              
        }else{            
            document.getElementById('obligatorioDescripcion').style.display='none';
        }

        if (imagen.files.length !== 1){
            document.getElementById('obligatorioImg').style.display='inline';
            valido=false;
        }else{
            imagen = imagen.files[0];
            let extension = imagen.name.split('.').pop();
            if(((extension!=='png') && (extension!=='jpeg') && (extension!=='jpg')) || (imagen.size>40000)){
                document.getElementById('obligatorioImg').style.display='inline';
                valido=false;
            }else{
                document.getElementById('obligatorioImg').style.display='none';
            }
        }
        
        if (plataforma==''){
            document.getElementById('obligatorioPlataforma').style.display='inline';
            valido=false;
        }else{
            document.getElementById('obligatorioPlataforma').style.display='none';
        }
        
        if (genero==''){
            document.getElementById('obligatorioGenero').style.display='inline';
            valido=false;
        }else{
            document.getElementById('obligatorioGenero').style.display='none';
        }
        
        if ((url.length>80)||(url=='')){
            document.getElementById('obligatorioURL').style.display='inline';
            valido=false;
        }else{
            document.getElementById('obligatorioURL').style.display='none';  
        }

        return valido;
        
}

function resetCampos(){
    /*OCULTO ERROR*/
    document.getElementById('obligatorioURL').style.display='none';  
    document.getElementById('obligatorioGenero').style.display='none';
    document.getElementById('obligatorioNombre').style.display='none';
    document.getElementById('obligatorioDescripcion').style.display='none';
    document.getElementById('obligatorioImg').style.display='none';
    document.getElementById('obligatorioPlataforma').style.display='none';
}