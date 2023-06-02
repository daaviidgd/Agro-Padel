<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "admin";
$password = "abc123.";
$dbname = "agropadel";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario de registro
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$email = $_POST['email'];

// Verificar si la contraseña y su confirmación coinciden
if ($password != $cpassword) {
  echo "Las contraseñas no coinciden";
  exit();
}

// Verificar si se envían todos los campos necesarios
if (empty($username) || empty($password) || empty($cpassword) || empty($email)) {
  echo "Por favor, completa todos los campos del formulario";
  exit();
}

// Encriptar la contraseña para almacenarla de forma segura en la base de datos
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar el nuevo usuario en la tabla de usuarios utilizando una consulta preparada
$sql = "INSERT INTO usuarios (user, pass, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $hashed_password, $email);

if ($stmt->execute()) {
  echo "Usuario registrado exitosamente";
} else {
  echo "Error al registrar usuario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>