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
            <h1>
                L&L GAMES
            </h1>
        </div>

        <div>
            <button class="boton" onclick="location.href='pages/altaJuego.php'">
                AGREGAR JUEGO
            </button>
        </div>
    </header>

    <main>
        <?php include_once('conexionBD.php'); 

                include_once('post.php');

        ?>
        <div>
            <form id="form1" name="form1" method="post" action="index.php">
                <div class="col-12 row">
                    <div class="mb-3">
                        <label class="form-label">Nombre a buscar</label>
                        <input type="text" class="form-control" name="buscar" id="buscar" value="<?php echo $_POST["buscar"]?>">
                    </div>

                    <h4 class="card-title">Filtro de busqueda</h4>

                    <div class="col-11">
                        <table class="table">
                            <th>
                                <tr class="filters">
                                    <th>
                                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>

                                        <select id="buscarGenero" name="buscarGenero" class="form-select mt-2" <?php if ($_POST["buscarGenero"]!=''){ ?> >
                                            <option value="<?php echo $_POST["buscarGenero"]; ?>" <?php echo $_POST["buscarGenero"]; ?>></option>
                                            <?php } ?>
                                            <option value="">GENERO</option>
                                            <option value="1">Acción</option>
                                            <option value="2">Deporte</option>
                                            <option value="3">Estrategia</option>
                                            <option value="4">Aventura</option>
                                            <option value="3">Terror</option>
                                        </select>
                                    </th>

                                    <th>
                                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>

                                        <select id="buscarPlataforma" name="buscarPlataforma" class="form-select mt-2" <?php if ($_POST["buscarPlataforma"]!='') { ?> >
                                            <option value="<?php echo $_POST["buscarPlataforma"]; ?>" <?php echo $_POST["buscarPlataforma"]; ?> >
                                            </option>
                                            <?php } ?>
                                            <option value="">PLATAFORMA</option>
                                            <option value="1">PC</option>
                                            <option value="2">PlayStation</option>
                                            <option value="3">Xbox</option>
                                        </select>
                                    </th>
                                </tr>
                            </th>
                        </table>
                    </div>
                    
                    <h4 class="card-title">Ordenar Por</h4>
                    
                    <div class="col-11">
                        <table class="table">
                            <thead>
                                <tr class="filters">
                                    <th>
                                        Seleccione el Orden

                                        <select id="orden" name="orden" class="form-control mt-2"> 
                                            <?php if ($_POST["orden"]!='') { ?>

                                            <option value="<?php echo $_POST["orden"];?>">
                                                <?php
                                                    if ($_POST["orden"]=='1'){echo 'Ordenar por nombre';}
                                                    //if ($_POST["orden"]=='2'){echo 'Ordenar por fecha de lanzamiento';}
                                                ?>
                                            </option>
                                            <?php } ?>
                                            <option value=""></option>
                                            <option value="1">Ordenar por nombre</option>
                                            <!-- <option value="2">Ordenar por fecha de lanzamiento</option> -->
                                        </select>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="col-1">
                        <input type="submit" class="btn" value="ver">
                    </div>
                </div>
                
                <?php 
                    /* FILSTRO DE BUSQUEDA */
                    if ($_POST['buscar'] == ''){
                        $_POST['buscar']=' ';
                    }
                    $aKeyword= explode(" ",$_POST['buscar']);
                    
                    
                    if ($_POST["buscar"]=='' and $_POST["buscarGenero"]=='' and $_POST["buscarPlataforma"]==''){
                        $query = "SELECT * FROM juegos";
                    }else{
                        $query = "SELECT * FROM juegos";

                        if ($_POST["buscar"]!=''){
                            $query .= "WHERE (nombre LIKE LOWER {"%".$aKeyword[0]}";
                        }

                        for ($i=1; $i <count($aKeyword);$i++){
                            if (!empty($aKeyword[$i])){
                                $query .= "OR nombre LIKE '%'" . $aKeyword[$i] ;
                            }
                        }
                    

                        if ($_POST["buscarGenero"] != '' ){
                            $query .= " AND genero = '".$_POST['buscarGenero']."' ";
                        } 

                        if ($_POST["buscarPlataforma"] != '' ){
                            $query .= " AND plataforma = '".$_POST['buscarPlataforma']."' ";
                        } 

                        if ($_POST["orden"]== '1'){
                            $query .= "ORDEN BY nombre ASC";
                        }

                    }
                    $sql = $link->query($query);

                    $numeroSql = mysqli_num_rows($sql);
                ?>


                <p> <i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados Encontrados</p>


            </form>     
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Plataforma</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php While($rowSql = $sql->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $rowSql["nombre"] ?></td>
                            <td><?php echo $rowSql["buscarGenero"] ?></td>
                            <td><?php echo $rowSql["buscarPlataforma"] ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
<!--
        </div>
        <div class="filtrado p-2">
            <div class="row g-3 p-3 d-flex justify-content-between align-items-center">
                <div class="col-3">
                  <input id="filtroNombre" type="text" class="form-control" placeholder="NOMBRE" aria-label="Nombre">
                </div>

                <div class="col-3">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select id="filtroGenero" class="form-select">
                    <option value="">GENERO</option>
                      <option value="1">Acción</option>
                      <option value="2">Deporte</option>
                      <option value="3">Estrategia</option>
                      <option value="4">Aventura</option>
                      <option value="3">Terror</option>
                    </select>
                </div>

                <div class="col-2">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select id="filtroPlataforma" class="form-select">
                    <option value="">PLATAFORMA</option>
                      <option value="1">PC</option>
                      <option value="2">PlayStation</option>
                      <option value="3">Xbox</option>
                    </select>
                </div>

                <div class="col-2">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select id="filtroOrdenar" class="form-select">
                      <option value="">ORDENAR</option>
                      <option value="1">Alfabeticamente</option>
                      <option value="2">Año de lanzamiento</option>
                    </select>
                </div>

                <div class="col-2">
                    <input class="boton" onclick="validarFiltro()" type="submit" value="FILTRAR">
                </div>
            </div>
        </div>
-->
<!--
        <div class="container mt-3">
            <div class="row">
                    <?php
                        include_once('conexionBD.php');

                        $sql = "SELECT `nombre`,`descripcion`,`url`,`id_genero`,`id_plataforma` FROM `juegos`"; 
                        $resultSet = mysqli_query($link, $sql); //selecciono todo de la tabla juegos

                        while ($row= mysqli_fetch_row($resultSet)){
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card m-2">
                                    <img src="images/<?php echo $row[3]; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row[0]; ?></h5>
                                        <p class="card-text">
                                            <?php echo $row[1]; ?>
                                        </p>
                                        <p class="card-text">
                                            Genero : <?php echo $row[3]; ?>
                                        </p>
                                        <p class="card-text">
                                            Plataforma : <?php echo $row[4]; ?>
                                        </p>
                                        <a href="<?php echo $row[2]; ?>" class="btn btn-primary">
                                            Link
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    ?>
                </div>
        </div>
-->
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