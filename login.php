<?php
session_start();
include 'conexao.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "SELECT * FROM tb_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['isLoggedin'] = true;
        $response['isLoggedIn'] = true;
        $response['redirect'] = 'indexlogado.php';

    } else {
        $_SESSION['isLoggedin'] = false;
        $response['isLoggedIn'] = false;
        $response['redirect'] = ''; 
    }
    
} else {
    $response['isLoggedIn'] = false;
    $error_message = "Credenciais inválidas.";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
