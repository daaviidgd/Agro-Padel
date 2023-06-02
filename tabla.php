<?php
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

// obtener el día seleccionado
$dia = $_POST["fecha"];

// pistas disponibles
$pistas = array("Pista 1", "Pista 2", "Pista 3","Pista 4","Pista 5");
//h2 encima de la tabla
echo '<h2 class="text-center mt-5">Horario Pistas</h2>'; 
// crear la tabla de horas disponibles para todas las pistas y el día seleccionado
echo '<table class="table table-bordered mt-4 text-center">';
echo '<thead>';
echo '<tr>';
echo '<th>Hora</th>';
foreach ($pistas as $pista) {
  echo '<th>' . $pista . '</th>';
}
echo '</tr>';
echo '</thead>';
echo '<tbody>';
for ($hora = 8; $hora <= 21; $hora += 1) {
  echo '<tr>';
  echo '<td>' . $hora . ':00 - ' . ($hora + 1) . ':00</td>';
  foreach ($pistas as $pista) {
    $sql = "SELECT COUNT(*) as reservas FROM reservas WHERE fecha='" . $dia . "' AND pista='" . $pista . "' AND hora='" . $hora . "'";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    $clase = ($fila["reservas"] > 0) ? 'ocupada' : 'disponible';
    echo '<td class="' . $clase . '">';
    if ($fila["reservas"] > 0) {
      echo 'Ocupado';
    } else {
      echo '<a href="reservar.php?dia=' . $dia . '&hora=' . $hora . '&pista=' . $pista . '">Reservar</a>';
    }
    echo '</td>';
  }
  echo '</tr>';
}
echo '</tbody>';
echo '</table>';

// cerrar la conexión a la base de datos
$conn->close();
?>