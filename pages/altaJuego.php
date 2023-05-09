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
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <header class="d-flex justify-content-between p-3 align-items-center">
        
        <div>
            <img class="logo" src="../img/logo.png" alt="logoPagina">     
        </div>

        <div>
            <h1>
                L&L GAMES
            </h1>
        </div>

        <div>
            <button class="boton" onclick="location.href='../index.php'">
                HOME
            </button>
        </div>
    </header>
    <main>
        <?php 
            include_once('../conexionBD.php'); 
            include_once('../cargaDatosDinamicos.php');
        ?>
        <div id="contenedorForm">
            <form id="formularioCarga" action="../cargarTabla.php" method="POST" enctype="multipart/form-data">
                <div class="p-3">
                    <h3>CARGAR JUEGO </h3>
                        <div class="m-4">
                            <!--Obligatorio-->                 
                            <input id="inputNombre" name="inputNombre" type="text" placeholder="NOMBRE">
                            <p id="obligatorioNombre" class="obligatorio">*</p>
                        </div>                    
                        <div class="m-4">
                            <!--Obligatorio-->
                            <input id="inputImagen" name="inputImagen" type="file">
                            <p id="obligatorioImg" class="obligatorio">*</p>
                        </div>
                        <div class="m-4">
                            <!--Max 255 caracteres-->
                            <textarea id="inputDescripcion" name="inputDescripcion" placeholder="DESCRIPCION" rows="3" cols="30" type="textarea"></textarea>
                            <p id="obligatorioDescripcion" class="obligatorio fs-6">Max 255 caracteres</p>
                        </div>
                        <div class="m-4">
                            <!--Opcion-->
                            <p class="parrafoFormulario d-inline">PLATAFORMA</p>
                                <select name="inputPlataforma" id="inputPlataforma">
                                    <option value="">-</option>
                                    <?php
                                    if (mysqli_num_rows($resultadoPlataforma) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultadoPlataforma)) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                                        } 
                                        }
                                    ?>
                                </select>
                                <p id="obligatorioPlataforma" class="obligatorio">*</p>
                        </div>
                        <div class="m-4">
                            <input id="inputUrl" name="inputUrl" type="url" placeholder="URL JUEGO">
                            <p id="obligatorioURL" class="obligatorio fs-6">Max 80 caracteres</p>
                        </div>
                        <div class="m-4">
                            <p class="parrafoFormulario d-inline">GENERO</p>
                                <select  id="inputGenero" name="inputGenero">
                                    <option value="">-</option>
                                    <?php
                                        if (mysqli_num_rows($resultadoGenero) > 0) {
                                            while ($row = mysqli_fetch_assoc($resultadoGenero)) {
                                                echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                                            }                
                                        }
                                    ?>
                                </select>
                            <p id="obligatorioGenero" class="obligatorio">*</p>
                        </div>
                        <div>
                            <a class="boton" id="enviarForm" href="js/validacion.js"> Enviar </a>
                            <input class="boton" type="reset" onclick="resetCampos()" value="BORRAR">
                        </div>
                </div>
            </form>
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
    <script src="../js/validacion.js"></script>
</body>
</html>