<?php
    $sqlGenero = "SELECT id, nombre FROM generos";
    $sqlPlataforma = "SELECT id, nombre FROM plataformas";                
    $resultadoGenero = mysqli_query($conn, $sqlGenero);
    $resultadoPlataforma = mysqli_query($conn, $sqlPlataforma);
?>