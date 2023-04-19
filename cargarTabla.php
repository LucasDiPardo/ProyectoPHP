<?php

include('conexionBD.php');



mysqli_query($link, "INSERT INTO `juegos` (`id`, `nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES (NULL, 'ejemplo', 'imagen', '', 'descripcion', 'url', '1', '1'");


?>