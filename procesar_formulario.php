<?php
include ("conn.php");

// Habilitar el reporte de errores y la visualización en caso de desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $nic = isset($_POST["nicValidar"]) ? $conn->real_escape_string($_POST["nicValidar"]) : "";
    $coordenadas_gps = isset($_POST["coordenadas"]) ? $conn->real_escape_string($_POST["coordenadas"]) : "";
    $actividad_comercial = isset($_POST["actividadComercial"]) ? $conn->real_escape_string($_POST["actividadComercial"]) : "";
    $tipo_de_medida = isset($_POST["tipoMedida"]) ? $conn->real_escape_string($_POST["tipoMedida"]) : "";
    $ubicacion_de_medida = isset($_POST["ubicacionMedida"]) ? $conn->real_escape_string($_POST["ubicacionMedida"]) : "";
    $kva_encontrado = isset($_POST["kvaEncontrado"]) ? $conn->real_escape_string($_POST["kvaEncontrado"]) : "";
    $resultado_inspeccion_visual = isset($_POST["resultadoInspeccion"]) ? $conn->real_escape_string($_POST["resultadoInspeccion"]) : "";
    $novedad_encontrada = isset($_POST["novedadEncontrada"]) ? $conn->real_escape_string($_POST["novedadEncontrada"]) : "";
    $observaciones_generales = isset($_POST["observaciones"]) ? $conn->real_escape_string($_POST["observaciones"]) : "";

    // Validación de datos (puedes agregar más validaciones según tus necesidades)

    if (empty($nic) || empty($coordenadas_gps) || empty($actividad_comercial) || empty($tipo_de_medida) || empty($ubicacion_de_medida) || empty($kva_encontrado) || empty($resultado_inspeccion_visual)) {
        die("Error: Por favor, completa todos los campos obligatorios.");
    }

    // Actualizar o insertar datos en la tabla Medidas
    $sql = "INSERT INTO medidas (NIC, CORDENADAS_GPS, actividad_comercial, tipo_de_medida, ubicacion_de_medida, kva_encontrado, resultado_inspeccion_visual, novedad_encontrada, observaciones_generales) 
            VALUES ('$nic', '$coordenadas_gps', '$actividad_comercial', '$tipo_de_medida', '$ubicacion_de_medida', '$kva_encontrado', '$resultado_inspeccion_visual', '$novedad_encontrada', '$observaciones_generales') 
            ON DUPLICATE KEY UPDATE 
            CORDENADAS_GPS = '$coordenadas_gps', actividad_comercial = '$actividad_comercial', tipo_de_medida = '$tipo_de_medida', 
            ubicacion_de_medida = '$ubicacion_de_medida', kva_encontrado = '$kva_encontrado', resultado_inspeccion_visual = '$resultado_inspeccion_visual', 
            novedad_encontrada = '$novedad_encontrada', observaciones_generales = '$observaciones_generales', NIC = NIC";

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