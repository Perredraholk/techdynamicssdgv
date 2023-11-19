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
		<title>Tela Principal</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" href="styleHome.css">

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
	<body style="background-position: center center; background-image: url('fundo.png'); background-size: 100% 200%; background-repeat: no-repeat; margin-bottom: 0%;" class="fundo">

	<nav>
		<div>
			<img id="logomen" src="NovaLogo.png" />
		</div>
		</li>
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

			<ul class="login">
            <?php
                if (isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true) {
                    echo '<li><a class="login" href="logout.php">Logout</a></li>';
                }
                ?>
		</ul>
	</nav>
	<div> 
		<div>
				<img style="margin-left:780px; margin-top:100px; width:260px;" id="logomen" src="NovaLogo.png" />
			</div>
				<br>
				</div>
				<br>
			<div style="margin-top:150px" class="ong">
				<h3>Parceiros de projeto de ONGs<br> Para saber mais clique aqui: <a style="color: #0ae7f7ea; text-decoration: none;" href="https://voluntariadosunidos.online/index.html" target="_blank">ArticBlue</a></h3>
			</div>
		</div>
		<div class="footer">
			<footer>		
				<p>Contato</p><br>
				<p style="text-align: left; margin-left: 550px;margin-top: -16px;"><img id="whats" src="whats.png" />+55(11)95048-9761</p>
				<p style="text-align: right; margin-right: 400px; margin-top: -10px;">E-mail: techsdynamcis@gmail.com</p>

			</footer>
		</div>
</body>
<script src="script.js"></script>
</html>

