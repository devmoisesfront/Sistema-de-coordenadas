<?php
// Connection parameters
$servername = "your_database_host";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$coordenadas = $_POST['coordenadas'];
$actividadComercial = $_POST['actividadComercial'];
$tipoMedida = $_POST['tipoMedida'];
$ubicacionMedida = $_POST['ubicacionMedida'];
$kvaEncontrado = $_POST['kvaEncontrado'];
$resultadoInspeccion = $_POST['resultadoInspeccion'];
$novedadEncontrada = $_POST['novedadEncontrada'];
$requiereRevision = $_POST['requiereRevision'];
$tipoLector = $_POST['tipoLector'];
$observaciones = $_POST['observaciones'];

// Insert data into the database
$sql = "INSERT INTO your_table_name (coordenadas, actividadComercial, tipoMedida, ubicacionMedida, kvaEncontrado, resultadoInspeccion, novedadEncontrada, requiereRevision, tipoLector, observaciones)
        VALUES ('$coordenadas', '$actividadComercial', '$tipoMedida', '$ubicacionMedida', '$kvaEncontrado', '$resultadoInspeccion', '$novedadEncontrada', '$requiereRevision', '$tipoLector', '$observaciones')";

if ($conn->query($sql) === TRUE) {
    echo "Formulario enviado y datos almacenados en la base de datos correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
