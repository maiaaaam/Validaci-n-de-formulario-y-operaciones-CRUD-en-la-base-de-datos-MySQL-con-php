<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// realizar la consulta a la base de datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de Usuarios Registrados</h2>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellido1'] . "</td>";
        echo "<td>" . $row['apellido2'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['login'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No hay usuarios registrados.";
}

$conn->close();
?>