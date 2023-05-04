<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TP - ENTREGA 1</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    
    <header class="d-flex justify-content-between p-3 align-items-center">

        <div>
            <img class="logo" src="img/logo.png" alt="logoPagina">     
        </div>

        <div>
            <h1>L&L GAMES</h1>
        </div>

        <div>
            <button class="boton" onclick="location.href='pages/altaJuego.php'">
                AGREGAR JUEGO
            </button>
        </div>
    </header>

    <main class="d-flex justify-content-center p-2">
        <?php 
        include_once('conexionBD.php'); 
        ?>

        <div class="container">
            <form id="form1" name="form1" method="POST" action="index.php">

                <div class="row">
                    <h4 class="text-light">Nombre a Buscar</h4>
                    <input type="text" class="form-control m-2" name='buscar' id='buscar' >
                </div>

                <div class="row">
                    
                    <table class="table">
                            <tr>
                                <td class="col-4">
                                    <h6 class="text-light">Genero</h6>
                                </td>
                                <td class="col-4">
                                    <h6 class="text-light" >Plataforma</h6>
                                </td>
                                <td class="col-4">
                                    <h6 class="text-light" >Orden</h6>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <select id='buscarGenero' name='buscarGenero' class="form-select mt-2">
                                        <option value=''>-</option>
                                        <option value='1'>Acción</option>
                                        <option value='2'>Deporte</option>
                                        <option value='3'>Terror</option>
                                        <option value='4'>Estrategia</option>
                                        <option value='5'>Aventura</option>
                                    </select>
                                </td>
                                <td>
                                        <select id='buscarPlataforma' name='buscarPlataforma' class="form-select mt-2">
                                            <option value=''>-</option>
                                            <option value='1'>PC</option>
                                            <option value='2'>PlayStation</option>
                                            <option value='3'>Xbox</option>

                                        </select>
                                    </td>

                                    <td>                                        
                                        <select id='orden' name='orden' class="form-control mt-2"> 
                                            <option value=''>-</option>
                                            <option value="1">Ordenar por nombre</option>
                                        </select>
                                    </td>

                            </tr>
                        </table>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" class="boton inline" value="Aplicar Filtros" >
                        <button class="boton" onclick="limpiarFiltros()">Eliminar Filtros</button>
                    </div>
                </div>
                
            </form>
                <?php                    
                        if (empty($_POST['buscar']) && (empty($_POST['buscarGenero'])) && (empty($_POST['buscarPlataforma']))){
                            $consulta = "SELECT * FROM juegos";
                        }
                        else{
                            $consulta = "SELECT * FROM juegos";

                            if (!empty($_POST['buscar'])){ //si el buscar no es vacio hace esto
                                $consulta .= ' WHERE nombre like "%' . $_POST['buscar'] . '%"';

                                if (!empty($_POST['buscarGenero'])) {                            
                                    $buscarGenero = $_POST['buscarGenero'];
                                    $consulta .= ' AND id_genero = '. $buscarGenero;
                                }
    
                                if (!empty($_POST['buscarPlataforma'])) {
                                    $buscarPlataforma = $_POST['buscarPlataforma'];
                                    $consulta .= ' AND id_plataforma = '. $buscarPlataforma;
                                }
    
                            }else{ //si el buscar es vacio hace esto
                                if (!empty($_POST['buscarGenero'])){ //si el genero no es vacio
                                    $buscarGenero = $_POST['buscarGenero'];
                                    $consulta .= ' WHERE id_genero = '. $buscarGenero;
    
                                    if (!empty($_POST['buscarPlataforma'])) {
                                        $buscarPlataforma = $_POST['buscarPlataforma'];
                                        $consulta .= ' AND id_plataforma = '. $buscarPlataforma;
                                    }

                                }else{ //si el genero es vacio hace esto
                                    if (!empty($_POST['buscarPlataforma'])) {
                                        $buscarPlataforma = $_POST['buscarPlataforma'];
                                        $consulta .= ' WHERE id_plataforma = '. $buscarPlataforma;
                                    }  
                                }
                            }
                        }
                        //va afuera                                               
                        if (!empty($_POST['orden'])){
                            $orden= $_POST['orden'];
                            if ($orden == '1'){
                                $consulta .= " ORDER BY nombre ASC";
                        }
                        }

                    $resultado = mysqli_query($conn,$consulta);            
                    $numeroSql = mysqli_num_rows($resultado);                 
                ?>

                <p class="text-light"> <i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados Encontrados</p>
                
                <div style="overflow-x:hidden;" class="table-responsive">
                    <div class="row"> 
                                      
                        <?php                   
                        if ($resultado){
                        while ($row = $resultado->fetch_array()){ 
                        ?>                    
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card m-1">                                
                                    <!--Imagen -->    
                                    <?php
                                        $base64 = 'data:image/'.$row['tipo_imagen'].';base64,'.($row['imagen']);                                                                             
                                        echo '<img class="card-img-top" src="'.$base64.'"/>';
                                    ?>
                                    
                                    <div class="card-body">
                                        <!--Nombre-->
                                            <h2 class="card-text">
                                                <?php echo $row['nombre']; ?>
                                            </h2>
                                        
                                        <!--Genero -->
                                            <p class="card-text">
                                            <?php
                                                switch ($row['id_genero']) {
                                                    case 1:
                                                        echo 'Acción';
                                                        break;
                                                    case 2:
                                                        echo 'Deporte';
                                                        break;
                                                    case 3:
                                                        echo 'Terror';
                                                        break;
                                                    case 4:
                                                        echo 'Estrategia';
                                                        break;
                                                    case 5:
                                                        echo 'Aventura';
                                                        break;
                                                }
                                            ?>
                                            </p>

                                        <hr>
                                        <!--Descripcion-->
                                            <p class="card-text">
                                                <?php echo $row['descripcion']; ?>
                                            </p>
                                        <hr>
                                            <!--Plataforma-->
                                            <p class="card-text">
                                            <?php
                                                switch ($row['id_plataforma']) {
                                                    case 1:
                                                        echo 'PC';
                                                        break;
                                                    case 2:
                                                        echo 'PlayStation';
                                                        break;
                                                    case 3:
                                                        echo 'Xbox';
                                                        break;
                                                }
                                            ?>
                                            </p>
                                            
                                            <!--Link-->
                                            <a href="<?php echo $row['url']; ?>" class="btn btn-primary" target="_blank">
                                                Link
                                            </a>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>
        </div>
    
        <?php if(!empty($_SESSION['nombre'])): ?>
            <script>
                document.body.classList.add("modalAbierto");
            </script>
            <div id="miModal" class="modalPersonalizado">
                <div class="contenidoModal">
                    <div class="modalHeader">
                        <span id="cerrar">&times;</span>
                        <h2>Juego agregado</h2>
                    </div>
                    <div class="modalBody">
                        <p>Se ha agregado <?php echo $_SESSION['nombre'] ?> a la lista de juegos </p>
                    </div>
                    <?php session_destroy() ?>
                    <div class="modalFooter">
                        <button id="botonCerrar" class="boton">Cerrar</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </main>
                
    <footer >
        <p>Lucas Corbalan - Lucas Di Pardo</p>
        <p>2023</p>
    </footer>

    <!--Js Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>

    <script src="js/validacionIndex.js"></script>
</body>

</html>