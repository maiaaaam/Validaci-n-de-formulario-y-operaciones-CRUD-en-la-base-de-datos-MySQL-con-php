<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];

// validar que todos los campos estén llenos
if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($password)) {
    die("Por favor, completa todos los campos.");
}

// validar el formato del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El formato del email no es válido.");
}

// validar la longitud de la contraseña
if (strlen($password) < 4 || strlen($password) > 8) {
    die("La contraseña debe tener entre 4 y 8 caracteres.");
}

// verificar si el email ya está registrado en la base de datos
$sql = "SELECT email FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("El email ya está registrado.");
}

// insertar los datos en la tabla de la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registro completado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>