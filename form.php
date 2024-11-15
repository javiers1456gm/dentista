<?php
// Configuración de la conexión a la base de datos
$host = 'servidornube.mysql.database.azure.com';
$username = 'javier@servidornube';
$password = 'Daniel12*'; // Reemplaza 'tu_contraseña' con la contraseña real
$dbname = 'mi_base_de_datos'; // Reemplaza con el nombre de tu base de datos
$port = 3306; // Especifica el puerto

// Crear conexión con el puerto especificado
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];
    
    // Mostrar los datos para verificar que se están recibiendo correctamente
    echo "Nombre: $nombre, Email: $email, Mensaje: $mensaje<br>";
    
    // Inserción en la base de datos
    $stmt = $conn->prepare("INSERT INTO datos_formulario (nombre, email, mensaje) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Cerrar la conexión al final
$conn->close();
?>
