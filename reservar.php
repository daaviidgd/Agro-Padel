<?php
session_start();
// credenciales para la conexión a la base de datos
$servername = "localhost";
$username = "admin";
$password = "abc123.";
$dbname = "agropadel";

// crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// verificar la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['dia']) && isset($_GET['hora']) && isset($_GET['pista']) && isset($_SESSION['user_id'])) {
    // Obtener los valores de los parámetros
    $fecha = $_GET['dia'];
    $hora = $_GET['hora'];
    $pista = $_GET['pista'];
    $idContacto = $_SESSION['user_id'];
    
    $sql = "INSERT INTO reservas (pista, hora, fecha, idContacto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $pista, $hora, $fecha, $idContacto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mostrar un mensaje emergente en la ventana anterior
        // Mostrar la información de la reserva
         // Mostrar la información de la reserva con estilos
        echo '<div style="text-align: center; margin-top: 50px;">';
        echo '<h1 style="color: blue;">Reserva realizada</h1>';
        echo '<p style="font-size: 18px;">Día: ' . $fecha . '</p>';
        echo '<p style="font-size: 18px;">Hora: ' . $hora . ':00</p>';
        echo '<p style="font-size: 18px;">Pista: ' . $pista . '</p>';
        echo '</div>';
        echo '<p style="text-align: center; margin-top: 20px;"><a style="color: blue; font-size: 16px;" href="javascript:history.back()">Volver</a></p>';

    } else {
        // Manejar el caso en que ocurra un error al ejecutar la consulta
        echo "Error al realizar la reserva: " . $stmt->error;
    }  
    // cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}else{
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<p style="color: red; font-size: 16px;">Debes estar loggeado</p>';
    echo '</div>';
    echo '<p style="text-align: center; margin-top: 20px;"><a style="color: blue; font-size: 16px;" href="javascript:history.back()">Volver</a></p>';
}


?>