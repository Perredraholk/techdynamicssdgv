<?php

$servername = "localhost";
$username = "13y5o1zdvbu3khxtnam6";
$password = "pscale_pw_8p0Jjeqw8xCAndFXCraekQYxmAMI4kzxNxrv28c4r2i";
$dbname = "techdynamicsdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
