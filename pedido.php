<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientenome = $_POST["clientenome"];
    $CPF_CNPJ = $_POST["CPF_CNPJ"];
    $logradouro = $_POST["logradouro"];
    $CEP = $_POST["CEP"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $bairro = $_POST["bairro"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $telefone = $_POST["telefone"];
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    //$valortotal = $_POST["valortotal"];
    $Obs = $_POST["Obs"];
    $Email = mysqli_real_escape_string($conn, $_POST["email"]);
    
    $sql_tb_pedido = "INSERT INTO tb_pedido (`ClienteNome`,`CPF_CNPJ`,`Cidade`,`Estado`,`Bairro`,`Numero`,`Complemento`,`CEP`,`DataCompra`,`Logradouro`,`Quantidade`,`Obs`,`Produto`, `Telefone`, `Email`)
VALUES ('$clientenome','$CPF_CNPJ','$cidade','$estado','$bairro','$numero','$complemento','$CEP',NOW(),'$logradouro', '$quantidade', '$Obs','$produto', '$telefone', '$Email')";

$sql_tb_analisepedido = "INSERT INTO tb_analisepedido (`NomeCliente`, `Produto`, `Quantidade`,`Telefone`, `CPF_CNPJ`,`datacompra`)
VALUES ('$clientenome', '$produto', '$quantidade', '$telefone', '$CPF_CNPJ',NOW() )";

if (mysqli_query($conn, $sql_tb_pedido) && mysqli_query($conn, $sql_tb_analisepedido)) {
    // Exibir notificação e redirecionar usando JavaScript
    echo '<script>';
    echo 'alert("Pedido registrado com sucesso!!.");';
    echo 'window.location.href = "pedido2.php";'; // Substitua "outra_pagina.php" pela página desejada
    echo '</script>';
} else {
    echo "Erro ao enviar os pedidos: " . mysqli_error($conn);
}

    
    mysqli_close($conn);
}
?>
