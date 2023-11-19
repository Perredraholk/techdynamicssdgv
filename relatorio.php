<?php
session_start();

if (!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] !== true) {
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Relatório</title>
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
        <h1>Relatório</h1>
    </div>
    <div class="formulario">
        <h1>Filtro</h1>
        <form method="POST" action="relatorio.php">
        <label for="status"> CPF_CNPJ:</label>
            <input type="text" id="CPF_CNPJ" name="CPF_CNPJ" placeholder="CPF_CNPJ">

            <label for="status"> Situacao:</label>
        <select name="Situacao" id="Situacao">
            <option value=""></option>
            <option value="Status Indefinido">Status Indefinido</option>
            <option value="Aprovado">Aprovado</option>
            <option value="Recusado">Recusado</option>
            <option value="Em Análise">Em Análise</option>
            <option value="Status Indefinido">Status Indefinido</option>
            <option value="'A Caminho'">A Caminho</option>
            <option value="Aguardando Pagamento">Aguardando Pagamento</option>
            <option value="Entregue">Entregue</option>
        </select>

        <button type="submit">Consultar</button>

        </form>

    </div>
    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Número do pedido</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                    <th>Prazo</th>
                    <th>CPF_CNPJ</th>
                    <th>Telefone</th>
                    <th style="text-align: center;">Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php

            include 'conexao.php';

                if (isset($_POST['CPF_CNPJ']) && isset($_POST['Situacao'])) {
                        $cpf_cnpj = $_POST['CPF_CNPJ'];
                        $Situacao = $_POST['Situacao'];

                        // Verifica as condições para construir a query apropriada
                        if (empty($cpf_cnpj) && empty($Situacao)) {
                            // Query quando tanto CPF_CNPJ quanto Situacao estão vazios
                            $sql = "SELECT A.ClienteNome, B.CodApedido, A.Quantidade, B.ValorTotal, B.Prazo, A.CPF_CNPJ, A.Telefone, B.status
                                    FROM tb_pedido A
                                    JOIN tb_analisepedido B ON A.CPF_CNPJ = B.CPF_CNPJ AND A.Codpedido = B.CodApedido" ;
                        } elseif (empty($cpf_cnpj)) {
                            // Query quando CPF_CNPJ está vazio
                            $sql = "SELECT A.ClienteNome, B.CodApedido, A.Quantidade, B.ValorTotal, B.Prazo, A.CPF_CNPJ, A.Telefone, B.status
                                    FROM tb_pedido A
                                    JOIN tb_analisepedido B ON A.CPF_CNPJ = B.CPF_CNPJ AND A.Codpedido = B.CodApedido
                                    WHERE B.status = '$Situacao'";
                        } elseif (empty($Situacao)) {
                            // Query quando Situacao está vazio
                            $sql = "SELECT A.ClienteNome, B.CodApedido, A.Quantidade, B.ValorTotal, B.Prazo, A.CPF_CNPJ, A.Telefone, B.status
                                    FROM tb_pedido A
                                    JOIN tb_analisepedido B ON A.CPF_CNPJ = B.CPF_CNPJ AND A.Codpedido = B.CodApedido
                                    WHERE A.CPF_CNPJ = '$cpf_cnpj'";
                        } else {
                            // Query quando ambos CPF_CNPJ e Situacao estão preenchidos
                            $sql = "SELECT A.ClienteNome, B.CodApedido, A.Quantidade, B.ValorTotal, B.Prazo, A.CPF_CNPJ, A.Telefone, B.status
                                    FROM tb_pedido A
                                    JOIN tb_analisepedido B ON A.CPF_CNPJ = B.CPF_CNPJ AND A.Codpedido = B.CodApedido
                                    WHERE A.CPF_CNPJ = '$cpf_cnpj' AND B.status = '$Situacao'";
                        }

                            $result = $conn->query($sql);



                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['ClienteNome'] . '</td>';
                            echo '<td>' . $row['CodApedido'] . '</td>';
                            echo '<td>' . $row['Quantidade'] . '</td>';
                            echo '<td>' . $row['ValorTotal'] . '</td>';
                            echo '<td>' . $row['Prazo'] . '</td>';
                            echo '<td>' . $row['CPF_CNPJ'] . '</td>';
                            echo '<td>' . $row['Telefone'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                     
                    }
                } 

                $conn->close();
                ?>
                
            </tbody>
        </table>
    </div>

</body>
</html>
