<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idPedido'])) {
        $idPedido = $_POST['idPedido'];
        $acao = $_POST['acao'];

        if ($acao === 'aprovar') {
            $novoStatus = 'Aprovado';
        } elseif ($acao === 'recusar') {
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
}

$sql = "SELECT * FROM tb_analisepedido";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Análise de Pedidos</title>
    <link rel="stylesheet" href="StyleTabela.css">

    <style>
        /* Estilos para a classe .menu */
        .menu {
            list-style-type: none;
            padding-top: 20%;
            text-align: left;
            font-size: larger;
            line-height: 30px;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <img src="NovaLogo.png" />
        </div>
        <ul class="menu">
            <li>
                <a href="indexlogado.php">Home</a>
            </li>
            <li>
				<a href="pedido2.php">Pedidos</a>
			</li>
			<li>
				<a href="analisePedido.php">Análise de Pedidos</a>
			</li>
            <li>
				<a href="relatorio.php">Relatório</a>
			</li>
            	
			<li>
				<a href="cadastro.html">Cadastro Login</a>
			</li>

			<li>
			<a href="novoproduto.html">Cadastro Produto</a>
			</li>

			<li>
				<a href="buscarid.php">Status do Pedido</a>
			</li>
        </ul>
    </nav>

    <div class="formulario">
        <h1>Análise de Pedidos</h1>
    </div>
    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Número do Pedido</th>
                    <th>CPF/CNPJ</th>
                    <th>Valor Total</th>
                    <th>Prazo</th>
                    <th>Status</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] === 'Status Indefinido' || $row['status'] === 'Em Análise'){
                        echo '<tr>';
                        echo '<td data-title="ClienteNome">' . $row['NomeCliente'] . '</td>';
                        echo '<td data-title="Número do Pedido">' . $row['CodApedido'] . '</td>';
                        echo '<td data-title="CPF/CNPJ">' . $row['CPF_CNPJ'] . '</td>';
                        echo '<td data-title="Valor Total">R$' . $row['ValorTotal'] . '</td>';
                        echo '<td data-title="Prazo">' .$row['Prazo']. '</td>';
                        echo '<td data-title="Status">' . $row['status'] . '</td>';
                        echo '<td data-title="Telefone">' . $row['Telefone'] . '</td>';
                        echo '<td>';
                        echo '<form method="post" action="analisePedido.php">';
                        echo '<input type="hidden" name="idPedido" value="' . $row['CodApedido'] . '">';
                        echo '<button style="width:80px;" class="btn-aprovar" type="submit" name="acao" value="aprovar">Aprovar</button>';
                        echo '<br>';
                        echo '<br>';
                        echo '<button style="width:80px;" class="btn-recusar" type="submit" name="acao" value="recusar">Recusar</button>';
                        echo '<br>';
                        echo '<br>';
                        echo '<a href="visualizar.php?id=' . $row['CodApedido'] . '"><button style="width:80px;" class="btn-visualizar" type="button">Visualizar</button></a>';
                        echo '</form>';
                        echo '</td>';
                        
                        echo '</tr>';
                    }
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
