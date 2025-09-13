<?php
// Incluir conexión a la base de datos
include 'db.php';

// Agregar un cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cliente'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];


    $sql = "INSERT INTO clientes (nombre, telefono, correo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $telefono, $email);

    if ($stmt->execute()) {
        echo "Cliente agregado correctamente.";
    } else {
        echo "Error al agregar cliente: " . $conn->error;
    }
}

// Agregar un vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_vehiculo'])) {
    $id_cliente = $_POST['id_cliente'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $placa = $_POST['placa'];  // Añadir la placa

    $sql = "INSERT INTO vehiculos (id_cliente, marca, modelo, año, placa) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issis", $id_cliente, $marca, $modelo, $año, $placa);  // Añadir parámetro de placa

    if ($stmt->execute()) {
        echo "Vehículo agregado correctamente.";
    } else {
        echo "Error al agregar vehículo: " . $conn->error;
    }
}


// Listar clientes (JSON)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar_clientes'])) {
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);

    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }

    echo json_encode($clientes);
}

// Listar vehículos (JSON)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar_vehiculos'])) {
    $sql = "SELECT v.*, c.nombre FROM vehiculos v JOIN clientes c ON v.id_cliente = c.id";
    $result = $conn->query($sql);

    $vehiculos = [];
    while ($row = $result->fetch_assoc()) {
        $vehiculos[] = $row;
    }

    echo json_encode($vehiculos);
}

?>
