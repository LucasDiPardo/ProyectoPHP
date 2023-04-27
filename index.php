<!DOCTYPE html>
<html lang="en">

<head>
    <title>TP - ENTREGA 1</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS-->
    <link rel="stylesheet" href="css/estilos.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
    
    <header class="d-flex justify-content-between p-1 align-items-center">

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

    <main>
        <?php 
        include_once('conexionBD.php'); 
        ?>

        <div class="container">
            <form id="form1" name="form1" method="POST" action="index.php">

                <div class="row">
                    <h4 class="card-title">Nombre a Buscar</h4>
                    <input type="text" class="form-control m-2" name='buscar' id='buscar' >
                </div>

                <div class="row">
                    
                    <table class="table">
                            <tr>
                                <td class="col-4">
                                    <h6>Genero</h6>
                                </td>
                                <td class="col-4">
                                    <h6>Plataforma</h6>
                                </td>
                                <td class="col-4">
                                    <h6>Orden</h6>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <select id='buscarGenero' name='buscarGenero' class="form-select mt-2">
                                        <option value=''>-</option>
                                        <option value='1'>Acción</option>
                                        <option value='2'>Deporte</option>
                                        <option value='3'>Estrategia</option>
                                        <option value='4'>Aventura</option>
                                        <option value='3'>Terror</option>
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
                    if (isset($_GET['mostrar_todos']) && $_GET['mostrar_todos'] == 'true') {
                        // Si se solicita mostrar todos los resultados, se omite la parte de la consulta que filtra los resultados
                        $consulta = "SELECT * FROM juegos";
                    } else {
                        // Si no se solicita mostrar todos los resultados, se construye la consulta con los filtros seleccionados por el usuario
                        if (empty($_POST['buscar']) && (empty($_POST['buscarGenero'])) && (empty($_POST['buscarPlataforma']))){
                            $consulta = "SELECT * FROM juegos";
                        }
                        else{
                            $consulta = "SELECT * FROM juegos";
    
                            //var_dump($_POST);die;
    
                            if (isset($_POST['buscar']) && (!empty($_POST['buscar']))){ //si el buscar no es vacio hace esto
                                $consulta .= ' WHERE nombre like "%' . $_POST['buscar'] . '%"';
                                //var_dump($consulta);
    
                                if (isset($_POST['buscarGenero'])&&(!empty($_POST['buscarGenero']))) {                            
                                    $buscarGenero = $_POST['buscarGenero'];
                                    $consulta .= ' AND id_genero = '. $buscarGenero;
                                    //var_dump($consulta);
                                }
    
                                if (isset($_POST['buscarPlataforma'])&&(!empty($_POST['buscarPlataforma']))) {
                                    $buscarPlataforma = $_POST['buscarPlataforma'];
                                    $consulta .= ' AND id_plataforma = '. $buscarPlataforma;
                                }
    
                            }else{ //si el buscar es vacio hace esto
                                if (isset($_POST['buscarGenero'])&&(!empty($_POST['buscarGenero']))){ //si el genero no es vacio
                                    $buscarGenero = $_POST['buscarGenero'];
                                    $consulta .= ' WHERE id_genero = '. $buscarGenero;
                                    //var_dump($consulta);
    
                                    if (isset($_POST['buscarPlataforma'])&&(!empty($_POST['buscarPlataforma']))) {
                                        $buscarPlataforma = $_POST['buscarPlataforma'];
                                        $consulta .= ' AND id_plataforma = '. $buscarPlataforma;
                                    }
    
                                }else{ //si el genero es vacio hace esto
                                    if (isset($_POST['buscarPlataforma'])&&(!empty($_POST['buscarPlataforma']))) {
                                        $buscarPlataforma = $_POST['buscarPlataforma'];
                                        $consulta .= ' WHERE id_plataforma = '. $buscarPlataforma;
                                        //var_dump($consulta);
                                    }  
                                }
    
                            }
                        }
                        //va afuera                                               
                        if (isset($_POST['orden'])&&(!empty($_POST['orden']))){
                            $orden= $_POST['orden'];
                            if ($orden == '1'){
                                $consulta .= " ORDER BY nombre ASC";
                        }
                        }
                    }               
                    //var_dump($consulta);die;

                    $resultado = mysqli_query($connn,$consulta);            
                    $numeroSql = mysqli_num_rows($resultado);                    
                ?>

                <p> <i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados Encontrados</p>
                
                <div class="table-responsive">
                    <div class="row">                
                        <?php                   
                        if ($resultado){
                        while ($row = $resultado->fetch_array()){ 
                        ?>                    
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card m-1">                                
                                    <!--Imagen -->    
                                    <img src="images/<?php echo $row[2]; ?>" class="card-img-top" alt="...">
                                    
                                    <div class="card-body">
                                        <!-- ID : <h1 class="card-title"><?php echo $row[0]; ?></h1> -->
                                        
                                        <!--Nombre-->
                                            <h2 class="card-text">
                                                <?php echo $row[1]; ?>
                                            </h2>
                                        
                                        <!--Genero -->
                                            <p class="card-text">
                                                <?php echo $row[6]; ?>
                                            </p>

                                        <hr>
                                        <!--Descripcion-->
                                            <p class="card-text">
                                                <?php echo $row[4]; ?>
                                            </p>
                                        <hr>
                                            <!--Plataforma-->
                                            <p class="card-text">
                                                Plataforma : <?php echo $row[7]; ?>
                                            </p>
                                            
                                            <!--Link-->
                                            <a href="<?php echo $row[5]; ?>" class="btn btn-primary" target="_blank">
                                                Link
                                            </a>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>
        </div>                
    </main>
                
    <footer>
        <p>Lucas Corbalan - Lucas Di Pardo</p>
        <p>2023</p>
    </footer>


    <!--Js Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
    <script src="js/validacion.js"></script>
</body>

</html>