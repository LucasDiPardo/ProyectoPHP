//debugger;
function validar(){

    let nombre=document.getElementById("inputNombre").value;
    let descripcion=document.getElementById("inputDescripcion").value.length;
    let imagen=document.getElementById("inputImagen").value;
    let plataforma=document.getElementById("inputPlataforma").value;
    let url=document.getElementById("inputUrl").value.length;
    let genero=document.getElementById("inputGenero").value;
    let valido=true;
    
        if (nombre=='') {
            document.getElementById('obligatorioNombre').style.display='inline';
            valido=false;
        }else{
            document.getElementById('obligatorioNombre').style.display='none';
        }
        
        //valido max 250 caracteres, puede estar vacio
        if (descripcion>250){            
            document.getElementById('obligatorioDescripcion').style.display='inline';              
            valido=false;
        }else{            
            document.getElementById('obligatorioDescripcion').style.display='none';
        }

        if (imagen==''){
            document.getElementById('obligatorioImg').style.display='inline';            
            valido=false;
        }else{
            document.getElementById('obligatorioImg').style.display='none';
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
        
        //valido max 80 caracteres, puede estar vacio
        if (url>80){
            document.getElementById('obligatorioURL').style.display='inline';         
            valido=false;
        }else{
            document.getElementById('obligatorioURL').style.display='none';  
        }
        
        event.preventDefault();    
        
        if (valido){
            $.post("cargarTabla.php",{"texto":miVariableJS},
            function(respuesta){
                alert(respuesta);});
        }
}

function resetCampos(){

    let nombre=document.getElementById("inputNombre").value;
    let descripcion=document.getElementById("inputDescripcion").value;
    let imagen=document.getElementById("inputImagen").value;
    let plataforma=document.getElementById("inputPlataforma").value;
    let url=document.getElementById("inputUrl").value;
    let genero=document.getElementById("inputGenero").value;

    /*OCULTO ERROR*/
    document.getElementById('obligatorioURL').style.display='none';  
    document.getElementById('obligatorioGenero').style.display='none';
    document.getElementById('obligatorioNombre').style.display='none';
    document.getElementById('obligatorioDescripcion').style.display='none';
    document.getElementById('obligatorioImg').style.display='none';
    document.getElementById('obligatorioPlataforma').style.display='none';

    //location.reload( forceGet );    


}

function validarFiltro(){

    let genero=document.getElementById('filtroGenero').value;
    let nombre= document.getElementById('filtroNombre').value;
    let plataforma=document.getElementById('filtroPlataforma').value;
    let ordenar= document.getElementById('filtroOrdenar').value;

    if ((genero=='')&&(nombre=='')&&(plataforma=='')&&(ordenar=='')){
        document.getElementById('filtroGenero').style.borderColor="red";
        document.getElementById('filtroNombre').style.borderColor="red";
        document.getElementById('filtroPlataforma').style.borderColor="red";
        document.getElementById('filtroOrdenar').style.borderColor="red";
    }else{
        document.getElementById('filtroGenero').style.borderColor="#dee2e6";
        document.getElementById('filtroNombre').style.borderColor="#dee2e6";
        document.getElementById('filtroPlataforma').style.borderColor="#dee2e6";
        document.getElementById('filtroOrdenar').style.borderColor="#dee2e6";        
    }
    event.preventDefault();
}

function limpiarFiltros(){
    // Llamamos a la URL del archivo PHP que procesa la consulta
    window.location.href = "index.php?mostrar_todos=true";
}