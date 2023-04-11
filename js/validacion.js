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

        
        if (nombre=='') {
            document.getElementById('obligatorioNombre').style.display='inline';
        }else{
            document.getElementById('obligatorioNombre').style.display='none';
        }
        
        if (descripcion==''){            
            document.getElementById('obligatorioDescripcion').style.display='inline';              
        }else{            
            document.getElementById('obligatorioDescripcion').style.display='none';
        }

        if (imagen==''){
            document.getElementById('obligatorioImg').style.display='inline';            
        }else{
            document.getElementById('obligatorioImg').style.display='none';
        }
        
        if (plataforma==''){
            document.getElementById('obligatorioPlataforma').style.display='inline';              
        }else{
            document.getElementById('obligatorioPlataforma').style.display='none';
        }
        
        if (genero==''){
            document.getElementById('obligatorioGenero').style.display='inline';
        }else{
            document.getElementById('obligatorioGenero').style.display='none';
        }
        
        if (url==''){
            document.getElementById('obligatorioURL').style.display='inline';         
        }else{
            document.getElementById('obligatorioURL').style.display='none';  
        }
        
        event.preventDefault();    
        

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

    location.reload( forceGet );    


}