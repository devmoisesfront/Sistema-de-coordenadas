<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "seguimiento";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = isset($_POST["nicValidar"]) ? $_POST["nicValidar"] : "";

    if (!empty($nic)) {
        $sql = "SELECT MT, CT, NIC, MC, TERRITORIO, CODIGO_SIC, NOMBRE, `LAT_DEF`,`LONG_DEF`, CIRCUITO FROM MEDIDA WHERE NIC = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            echo json_encode($data);
            exit;
        } else {
            echo json_encode(["error" => "No se encontraron resultados para el NIC proporcionado."]);
            $stmt->close();
            $conn->close();
            exit;
        }
    } else {
        echo json_encode(["error" => "DETENTE, NO TIENES PERMISO PARA ACCEDER. NO SEAS SAPO."]);
        $stmt->close();
        $conn->close();
        exit;
    }
} else {
    echo json_encode(["error" => "Estás intentando acceder a un lugar que no te interesa. No seas sapo."]);
    $conn->close();
    exit;
}
?>
