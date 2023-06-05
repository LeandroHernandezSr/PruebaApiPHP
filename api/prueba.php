<?php

function actualizarAlumno($id, $nombre, $apellido, $edad) {
    // Configuración de la conexión a la base de datos
    $servidor = "localhost:3310";
    $usuario = "root";
    $password = "";
    $baseDeDatos = "base4";
    
    // Crear la conexión
    $conexion = mysqli_connect($servidor, $usuario, $password, $baseDeDatos);
    
    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
    }
    
    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE alumno SET nombre = '$nombre', apellido = '$apellido', edad = '$edad' WHERE id = '$id'";
    
    // Ejecutar la consulta
    if (mysqli_query($conexion, $consulta)) {
        echo "Los datos del alumno se han actualizado correctamente.";
    } else {
        echo "Error al actualizar los datos del alumno: " . mysqli_error($conexion);
    }
    
    // Cerrar la conexión
    mysqli_close($conexion);
}

// Ejemplo de uso
$id = 3; // ID del alumno a actualizar
$nombre = "Juan";
$apellido = "Pérez";
$edad = 25;

actualizarAlumno($id, $nombre, $apellido, $edad);
?>
