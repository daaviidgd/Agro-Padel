<?php

// Conectar a la base de datos
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener datos del formulario de inicio de sesión
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Verificar si se envían todos los campos necesarios
  if (empty($username) || empty($password)) {
      echo "Por favor, completa todos los campos del formulario";
      exit();
  }

  // Validar y sanitizar las entradas del usuario
  $username = filter_var($username, FILTER_SANITIZE_STRING);

  // Buscar el usuario en la base de datos utilizando una consulta preparada
  $sql = "SELECT * FROM usuarios WHERE user=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows == 1) {
      $row = $resultado->fetch_assoc();
      
      // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
      if (password_verify($password, $row['pass'])) {
           echo "Usuario registrado exitosamente";
          // Guardar el ID del usuario en la sesión
          session_start();
          $_SESSION['user_id'] = $row['id'];
          // Redireccionar a la página de reservas u otra página deseada
          
      } else {
          echo "Contraseña incorrecta";
      }
  } else {
      echo "Usuario no encontrado";
  }
}


$conn->close();
?>