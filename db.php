<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ingreso';
$conexion = new mysqli($host, $user, $password, $dbname);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

function getUserData($email) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateUserData($email, $apellido, $nombre, $dni, $tel, $direccion, $fecha_nacimiento) {
    global $conexion;
    $stmt = $conexion->prepare("UPDATE clientes SET apellido = ?, nombre = ?, dni = ?, tel = ?, direccion = ?, fecha_nacimiento = ? WHERE email = ?");
    $stmt->bind_param("sssssss", $apellido, $nombre, $dni, $tel, $direccion, $fecha_nacimiento, $email);
    return $stmt->execute();
}
?>
