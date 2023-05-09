<?php
    $valido = true;
    if((empty($_POST['inputNombre'])) || (empty($_POST['inputDescripcion'])) || (empty($_FILES['inputImagen'])) || (empty($_POST['inputPlataforma'])) || (empty($_POST['inputUrl'])) || (empty($_POST['inputGenero']))){
        $valido = false;
        var_dump($_POST['inputNombre']);
        var_dump($_POST['inputDescripcion']);
        var_dump($_POST['inputImagen']);
        var_dump($_POST['inputPlataforma']);
        var_dump($_POST['inputUrl']);
        var_dump($_POST['inputGenero']);
    }
    else{
        $descripcion = $_POST['inputDescripcion'];
        if(strlen($descripcion)>255){
            $valido = false;
        }
        else {
            $url = $_POST['inputUrl'];
            if(strlen($url)>80){
                $valido = false;
            }
            else {
                //traer la extension de esta manera es mas seguro
                $extension = pathinfo($_FILES['inputImagen']['name'], PATHINFO_EXTENSION);
                if(($_FILES['inputImagen']['size']<40000) && (($extension=='jpg') || ($extension=='jpeg') || ($extension=='png'))){
                    $nombre = $_POST['inputNombre'];
                    $imagen = base64_encode(file_get_contents($_FILES['inputImagen']['tmp_name']));
                    $type = $_FILES['inputImagen']['type'];
                    $plataforma = $_POST['inputPlataforma'];
                    $genero = $_POST['inputGenero'];
                }
                else{
                    $valido=false;
                }
            }
        }
    }

    if($valido==true){
        include_once 'conexionBD.php';
        $sql = "INSERT INTO juegos (nombre, imagen, tipo_imagen, descripcion, id_genero, id_plataforma, url) VALUES ('$nombre', '$imagen', '$type', '$descripcion', '$genero', '$plataforma', '$url');";
        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['nombre'] = $nombre;
            header('Location: index.php');
            die();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        header('Location: pages/altaJuego.php');
        die();
    }
?>