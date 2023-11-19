<?php
session_start();
$isLoggedin = isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pedidos</title>
	<link rel="stylesheet" href="style.css">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

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

			<?php
				if ($isLoggedin) {
					echo '<li><a href="indexlogado.php">Home</a></li>';
				} else {
					echo '<li><a href="index.html">Home</a></li>';
				}
			?>

			</li>
			<li>
				<a href="pedido2.php">Pedidos</a>
			</li>

			</li>
            <?php
            if ($isLoggedin) {
                echo '<li><a href="analisePedido.php">Análise de Pedidos</a></li>';
                echo '<li><a href="relatorio.php">Relatório</a></li>';
				echo '<li><a href="cadastro.html">Cadastro Login</a></li>';
				echo '<li><a href="novoproduto.html">Cadastro Produto</a></li>';
            }
            ?>
            <li>

			<li>
				<a href="buscarid.php">Status do Pedido</a>
			</li>

				
		</ul>
	</nav>

	<div class="pedido">
		<h1>Pedidos</h1>
	</div>

	<div class="formulario">
		<form method="post" action="pedido.php">
			<label for="Nome">Cadastro do Cliente</label>
			<br>
			<br>
			<input type="text" id="clientenome" name="clientenome" placeholder="Nome Completo" required>
			<label for="CPF"></label>
			<input type="number" id="CPF_CNPJ" placeholder="CPF/CNPJ" name="CPF_CNPJ" required>
			<label for="Endereço"></label>
			<input type="text" id="logradouro" placeholder="Logradouro" name="logradouro" required>
			<input type="text" id="CEP" placeholder="CEP" name="CEP" required>
			<input type="text" id="cidade" placeholder="Cidade" name="cidade" required>
			<input type="text" id="estado" placeholder="Estado" name="estado" required>

			<input type="text" id="bairro" placeholder="Bairro" name="bairro" required>

			<input type="text" id="numero" placeholder="Número" name="numero" required>
			<input type="text" id="Complemento" placeholder="Complemento" name="complemento" required>
			<br>
			<br>
			<input type="text" id="email" placeholder="E-mail" name="email" required>
			
			<input type="number" id="telefone" placeholder="Telefone" name="telefone" required>
			<br>
			<br>
	</div>
	<div class="formulario">
		<label for="Produto">Pedido</label>
		<br>
		<br>
        <select id="produto" name="produto">
		<option value="" disabled selected hidden>Selecione o Produto</option>
            <?php
        include 'conexao.php';

            $query = "SELECT DescProduto FROM tb_produto";

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option>" . $row['DescProduto'] . "</option>";
            }

            mysqli_close($conn);
            ?>
        </select>
		<input style="width: 100px;" type="number" id="quantidade" name="quantidade" placeholder="Quantidade" required>
		<br>
		<br>
		<textarea id="Obs" name="Obs" placeholder="Qual é sua medida? Dimensão x Largura "></textarea>
		<br>
		<br>
		<button>
			<a style="color: #fff; text-decoration: none;" href="https://www.ufmg.br/prorh/wp-content/uploads/2023/05/Termo-de-Consentimento-para-Tratamento-de-Dados-Pessoais-Lei-Geral-de-Protecao-de-Dados-Pessoais-LGPD.pdf" target="_blank">Termo LGPD</a>
		</button>
		<input type="checkbox" id="check" name="Concordo" value="Sim" required> EU, CONCORDO COM OS TERMOS LGPD
		<br>
		<br>
		<button type="submit">Enviar Pedido</button>
		</form>
	</div>

</body>
</html>
