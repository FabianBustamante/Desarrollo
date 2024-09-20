<?php
$servername = "localhost";
$username = "root";
$clave = "";
$baseDeDatos = "formulario";


$enlace = mysqli_connect($servername, $username, $clave, $baseDeDatos);


$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$ocupacion = $_POST['ocupacion'];
$contacto = $_POST['contacto'];
$nacionalidad = $_POST['nacionalidad'];
$nivel_ingles = $_POST['nivel_ingles'];
$lenguaje = implode(", ", $_POST['lenguajes']);
$aptitudes = $_POST['aptitudes'];
$habilidades = implode(", ", $_POST['habilidades']);
$perfil = $_POST['perfil'];


$sql = "INSERT INTO datos (nombre, fecha_nacimiento, ocupacion, contacto, nacionalidad, nivel_ingles, lenguajes, aptitudes, habilidades, perfil)
VALUES ('$nombre', '$fecha_nacimiento', '$ocupacion', '$contacto', '$nacionalidad', '$nivel_ingles', '$lenguaje', '$aptitudes', '$habilidades', '$perfil')";

if (mysqli_query($enlace, $sql)) {
    echo "Datos guardados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
}


mysqli_close($enlace);
?>
