<?php

//armar la conexion
$conn = new mysqli("localhost", "root", "", "juegos");   //conexion con ese usuario contraseña y nombre de base
if($conn->connect_errno){
    echo "Fallo al conectar a MySQL: " . $conn->connect_error;
}

?>
