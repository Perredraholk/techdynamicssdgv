<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique qual botão foi pressionado
    if (isset($_POST["Salvar"])) {
        // O botão "Salvar" foi pressionado
        $idpedido = $_POST["idpedido"];
        $novo_valor_total = $_POST["novo_valor_total"];
        $novo_status = $_POST["novo_status"];
        $novo_prazo = $_POST["novo_prazo"];

        $sql = "UPDATE tb_analisepedido SET ValorTotal = '$novo_valor_total', status = '$novo_status', prazo = '$novo_prazo' WHERE CodApedido = $idpedido";

        if (mysqli_query($conn, $sql)) {
            // Exibir notificação e redirecionar usando JavaScript
            echo '<script>';
            echo 'alert("Dados atualizados com sucesso.");';
            echo 'window.location.href = "buscarid.php";'; // Substitua "outra_pagina.php" pela página desejada
            echo '</script>';
        } else {
            echo "Erro na atualização de dados: " . mysqli_error($conn);
        }
    } elseif (isset($_POST["voltar"])) {
        // O botão "Voltar" foi pressionado
        // Adicione aqui qualquer lógica específica para o botão "Voltar"
        // Se não precisar de nenhuma lógica específica, pode deixar vazio
        header("Location: buscarid.php"); // Redireciona para a página desejada
    }
}

mysqli_close($conn);
?>
