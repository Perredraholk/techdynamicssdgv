<?php
session_start();
include 'conexao.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $checkUserSql = "SELECT * FROM tb_users WHERE username = '$username'";
    $checkUserResult = $conn->query($checkUserSql);

    if ($checkUserResult->num_rows > 0) {
        $response['isRegistered'] = false;
        $response['message'] = 'Usuário já existe. Escolha outro nome de usuário.';
    } else {
        $insertSql = "INSERT INTO tb_users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($insertSql) === TRUE) {
            $response['isRegistered'] = true;
            $response['message'] = 'Registro bem-sucedido. Você pode fazer login agora.';
            $response['redirect'] = 'cadastro.html';
        } else {
            $response['isRegistered'] = false;
            $response['message'] = 'Erro ao cadastrar o usuário.';
        }
    }
} else {
    $response['isRegistered'] = false;
    $response['message'] = 'Método de requisição inválido.';
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
