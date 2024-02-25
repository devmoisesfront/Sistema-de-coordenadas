<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "127.0.0.1";  // Cambia esto con tu servidor MySQL
$username = "root";     // Cambia esto con tu usuario MySQL
$password = "";   // Cambia esto con tu contraseña MySQL
$dbname = "seguimiento"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $nic = isset($_POST["NIC"]) ? $_POST["NIC"] : "";
    $COORDENADAS_GPS = isset($_POST["coordenadas_gps"]) ? $_POST["coordenadas_gps"] : null;


    $actividad_comercial = isset($_POST["actividadComercial"]) ? $_POST["actividadComercial"] : "Default Value";
    $tipo_de_medida = isset($_POST["tipoMedida"]) ? $_POST["tipoMedida"] : "Default Value";
    $ubicacion_de_medida = isset($_POST["ubicacionMedida"]) ? $_POST["ubicacionMedida"] : "Default Value";
    $kva_encontrado = isset($_POST["kvaEncontrado"]) ? $_POST["kvaEncontrado"] : "Default Value";
    $resultado_inspeccion_visual = isset($_POST["resultadoInspeccion"]) ? $_POST["resultadoInspeccion"] : "Default Value";
    $novedad_encontrada = isset($_POST["novedadEncontrada"]) ? $_POST["novedadEncontrada"] : "Default Value";
    $observaciones_generales = isset($_POST["observaciones"]) ? $_POST["observaciones"] : "Default Value";

    // Actualizar o insertar datos en la tabla Medidas
    $sql = "INSERT INTO medida (NIC, CORDENADAS_GPS, actividad_comercial, tipo_de_medida, ubicacion_de_medida, kva_encontrado, resultado_inspeccion_visual, novedad_encontrada, observaciones_generales) 
            VALUES ('$nic', '$COORDENADAS_GPS', '$actividad_comercial', '$tipo_de_medida', '$ubicacion_de_medida', '$kva_encontrado', '$resultado_inspeccion_visual', '$novedad_encontrada', '$observaciones_generales') 
            ON DUPLICATE KEY UPDATE CORDENADAS_GPS = '$COORDENADAS_GPS', actividad_comercial = '$actividad_comercial', tipo_de_medida = '$tipo_de_medida', 
            ubicacion_de_medida = '$ubicacion_de_medida', kva_encontrado = '$kva_encontrado', resultado_inspeccion_visual = '$resultado_inspeccion_visual', 
            novedad_encontrada = '$novedad_encontrada', observaciones_generales = '$observaciones_generales'";

    if ($conn->query($sql) === TRUE) {
        echo "Formulario enviado correctamente";
    } else {
        echo "Error al enviar el formulario: " . $conn->error;
    }
} else {
    // Si se intenta acceder al archivo directamente, muestra un mensaje de error
    echo "Acceso no permitido";
}

// Cerrar la conexión
$conn->close();
?>
