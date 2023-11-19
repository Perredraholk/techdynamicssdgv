<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $Produto = $_POST["Produto"];

    $sql = "INSERT INTO tb_produto (DescProduto) VALUES ('$Produto')";

    if ($conn->query($sql) === TRUE) {

       // Exibir notificação e redirecionar usando JavaScript
       echo '<script>';
       echo 'alert("Produto Registrado!!.");';
       echo 'window.location.href = "novoproduto.html";'; // Substitua "outra_pagina.php" pela página desejada
       echo '</script>';
    } else {
        echo "Erro ao cadastrar o produto: " . $conn->error;
    }
}

$conn->close();
?>
