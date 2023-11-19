<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPedido = $_POST['idPedido'];
    $acao = $_POST['acao'];

    if ($acao === 'aprovar') {
        $novoStatus = 'Aprovado';
    } elseif ($acao === 'reprovar') {
        $novoStatus = 'Recusado';
    }

    $sql = "UPDATE tb_analisepedido SET status = '$novoStatus' WHERE CodApedido = $idPedido";
    $result = mysqli_query($conn, $sql); 

    if ($result) {
        header("Location: analisePedido.php");
        exit();
    } else {
        echo 'Erro ao atualizar o status: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
