<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $idPedido = $_GET['id'];

    $sql = "SELECT * FROM tb_pedido a  JOIN tb_analisepedido b ON a.CodPedido = b.CodApedido AND a.CPF_CNPJ = b.CPF_CNPJ WHERE a.CodPedido = $idPedido";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $pedido = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pedido</title>
    <link rel="stylesheet" href="stylevisu.css">
    <meta charset="UTF-8">
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

    <?php if (isset($pedido)) : ?>
    <div class="pedido">
        <h1>Pedido: <?php echo $pedido['CodPedido']; ?></h1>
    </div>

    <div class="formulario">
        <form>
            <label for="Data">Data da Compra:</label>
            <br>
            <input type="text" id="data" name="data" value="<?php echo $pedido['DataCompra']; ?>" readonly>
            <br>
            <label for="CPF_CNPJ">CPF/CNPJ:</label>
            <br>
            <input type="text" class="area" placeholder="CPF/CNPJ" name="CPF_CNPJ" value="<?php echo $pedido['CPF_CNPJ']; ?>" readonly>
            <br>
            <label for="Telefone">Telefone:</label>
            <br>
            <input type="text" class="area" placeholder="Telefone" name="Telefone" value="<?php echo $pedido['Telefone']; ?>" readonly>
            <br>
            <label for="Estado">Estado:</label>
            <br>
            <input type="text" class="area" placeholder="Estado" name="Estado" value="<?php echo $pedido['Estado']; ?>" readonly>
            <br>
            <label for="Cidade">Cidade:</label>
            <br>
            <input type="text" class="area" placeholder="Cidade" name="Cidade" value="<?php echo $pedido['Cidade']; ?>" readonly>
            <br>
            <label for="Logradouro">Logradouro:</label>
            <br>
            <input type="text" class="area" placeholder="Logradouro" name="Logradouro" value="<?php echo $pedido['Logradouro']; ?>" readonly>
            <br>
            <label for="Complemento">Complemento:</label>
            <br>
            <input type="text" class="area" placeholder="Complemento" name="Complemento" value="<?php echo $pedido['Complemento']; ?>" readonly>
            <br>
            <label for="Pedido">Descrição do Pedido:</label>
            <br>
            <br>
			<textarea class="desc" placeholder="Detalhes do Pedido" readonly>
Descrição: <?php echo $pedido['Produto']; ?>
			Quantidade: <?php echo $pedido['Quantidade']; ?>
										Comentário: <?php echo $pedido['Obs']; ?>
                                                        E-mail: <?php echo $pedido['Email']; ?>
                
            </textarea>
            
            <br>
            <button><a a style="text-decoration:none; color: #fff;" href="analisePedido.php">Voltar</a></button>
            <br>
        </form>
    </div>
            <div class="formulario">
                        <h1>Envio de Email : Departamento Financeiro</h1>
                     <form action="https://formsubmit.co/techsdynamcis@gmail.com" method="POST">
                            <input type="hidden" name="_next" value="https://techdynamicssdgv.000webhostapp.com/analisePedido.php" />
                            <input type="hidden" name="_captcha" value="false">s
                            <input type="email" name="email" placeholder="Digite seu E-mail" value="<?php echo $pedido['Email']; ?>" style="width: 300px;" />
                            <br>
                            <br>
                            <input type="text" name="Valor" placeholder="Valor do pedido" value=" <?php echo $pedido['ValorTotal']; ?>" style="width: 300px;" />
                            <br>
                            <br>
                <textarea class="desc" name="message" placeholder="Descrição do pedido" style="width: 300px;">
Descrição: <?php echo $pedido['Produto']; ?>
			Quantidade: <?php echo $pedido['Quantidade']; ?>
										Comentário: <?php echo $pedido['Obs']; ?>
                                                     Telefone: <?php echo $pedido['Telefone']; ?>
                </textarea>

                        <br>
                        <br>
                                    <button type="submit">Enviar</button>
                    </form>
            </div>

            <?php else : ?>
                <script>
                    // Redirecionar para a página analisePedido.php após um breve intervalo
                    setTimeout(function() {
                        window.location.href = 'analisePedido.php';
                    }, 1000); // Redirecionar após 3 segundos (ajuste conforme necessário)
                </script>

            <?php endif; ?>

            <form>
                <input type="button" class="sair" name="btn-sair" value="Sair" onclick="javascript:window.close()">
            </form>
    </body>
</html>
