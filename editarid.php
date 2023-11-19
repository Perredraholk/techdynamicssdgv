<!DOCTYPE html>

<html>
<head>
    <title>Editar Pedido</title>
    <link rel="stylesheet" href="editarid.css">
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
    <h1>Editar Pedido</h1>
    </div>
    <div class="formulario">
    <br>
    <br>
    <form method="POST" action="salvar_edicao.php">
        <?php
        include 'conexao.php';

        if (isset($_GET['idpedido'])) {
            $idpedido = $_GET['idpedido'];

            $sql = "SELECT * FROM tb_analisepedido WHERE CodApedido = $idpedido";
            $resultado = mysqli_query($conn, $sql);

            if ($resultado) {
                if (mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    echo '<input type="hidden" name="idpedido" value="' . $idpedido . '">';
                    
                    echo '<label for="valor_total">Valor Total (Antigo):</label>';
                    echo '<input type="text" name="valor_total" id="valor_total" value="' . $row['ValorTotal'] . '" readonly>';
                    echo '<br>';
                    echo '<br>';
                    
                    echo '<label for="status">Status do Pedido (Antigo):</label>';
                    echo '<input type="text" name="status" id="status" value="' . $row['status'] . '" readonly>';
                    echo '<br>';
                    echo '<br>';
                    
                    echo '<label for="prazo">Prazo (Antigo):</label>';
                    echo '<input type="text" name="prazo" id="prazo" value="' . $row['Prazo'] . '" readonly>';
                    echo '<br>';
                    echo '<br>';
                } else {
                    echo "Pedido não encontrado.";
                }
            } else {
                echo "Erro na consulta: " . mysqli_error($conn);
            }
        }
            ?>
            <br>
        <label for="valor_total">Novo Valor Total:</label>
        <input type="text" name="novo_valor_total" id="novo_valor_total">
        <br>
        <br>
        <label for="status">Novo Status do Pedido:</label>
        <select name="novo_status" id="novo_status">
            <option value="Aprovado">Aprovado</option>
            <option value="Recusado">Recusado</option>
            <option value="Em Análise">Em Análise</option>
            <option value="Status Indefinido">Status Indefinido</option>
            <option value="'A Caminho'">A Caminho</option>
            <option value="Aguardando Pagamento">Aguardando Pagamento</option>
            <option value="Entregue">Entregue</option>
        </select>
        <br>
        <br>
        <label for="prazo">Novo Prazo:</label>
        <input type="text" name="novo_prazo" id="novo_prazo">
        <br>
        <br>
        <button type="submit" name="Salvar">Salvar</button>

        <button type="submit" name="Voltar"><a href="buscarid.php">Voltar</a></button>
    </form>
    </div>
</body>
</html>
