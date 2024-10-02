<?php
// Conexión a la base de datos
$servername = "localhost";  // Cambia si es necesario
$username = "root";         // Cambia si es necesario
$password = "";             // Cambia si es necesario
$dbname = "cv_database";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre = $_POST['nombre'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $ocupacion = $_POST['ocupacion'];
    $contacto = $_POST['contacto'];
    $nacionalidad = $_POST['nacionalidad'];
    $nivel_ingles = $_POST['nivel_ingles'];
    $lenguajes = implode(",", $_POST['lenguajes']); // Convertir array en cadena separada por comas
    $aptitudes = $_POST['aptitudes'];
    $habilidades = implode(",", $_POST['habilidades']); // Convertir array en cadena separada por comas
    $perfil = $_POST['perfil'];

    // Insertar datos en la tabla cvs
    $sql = "INSERT INTO cvs (nombre, fecha_nacimiento, ocupacion, contacto, nacionalidad, nivel_ingles, lenguajes_programacion, aptitudes, habilidades, perfil) 
            VALUES ('$nombre', '$fecha_nacimiento', '$ocupacion', '$contacto', '$nacionalidad', '$nivel_ingles', '$lenguajes', '$aptitudes', '$habilidades', '$perfil')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el último ID insertado (id del CV)
        $cv_id = $conn->insert_id;

        // Guardar datos dinámicos (Experiencia, Formación, Idiomas, Aptitudes y Habilidades)
        if (!empty($_POST['experiencia'])) {
            foreach ($_POST['experiencia'] as $experiencia) {
                $sql = "INSERT INTO experiencia_laboral (cv_id, descripcion) VALUES ('$cv_id', '$experiencia')";
                $conn->query($sql);
            }
        }

        if (!empty($_POST['formacion'])) {
            foreach ($_POST['formacion'] as $formacion) {
                $sql = "INSERT INTO formacion (cv_id, descripcion) VALUES ('$cv_id', '$formacion')";
                $conn->query($sql);
            }
        }

        if (!empty($_POST['idiomas'])) {
            foreach ($_POST['idiomas'] as $idioma) {
                $sql = "INSERT INTO idiomas (cv_id, descripcion) VALUES ('$cv_id', '$idioma')";
                $conn->query($sql);
            }
        }

        if (!empty($_POST['aptitud'])) {
            foreach ($_POST['aptitud'] as $aptitud) {
                $sql = "INSERT INTO aptitudes_habilidades (cv_id, descripcion) VALUES ('$cv_id', '$aptitud')";
                $conn->query($sql);
            }
        }

        echo "Formulario enviado y guardado correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
