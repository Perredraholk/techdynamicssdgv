<?php
session_start();
$isLoggedin = isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status do Pedido</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Estilos para a classe .menu */
        .Menus {
            list-style-type: none;
            padding-top: 20%;
            text-align: left;
            font-size: larger;
            line-height: 30px;
        }

        .Menus li {
	position: relative;
}

.Menus li a {
	display: block;
	padding: 10px 15px;
	color: #fff;
	text-decoration: none;
}

.Menus li a:hover, .menu li a:focus {
	color: #0558EE;
}

.Menus li:hover .submenu {
	display: block;
}

    </style>
    
</head>
<body>
    <nav>
        <div>
            <img src="NovaLogo.png" />
        </div>
        <ul class="Menus">
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
            <?php
            if ($isLoggedin) {
                echo '<li><a href="analisePedido.php">Análise de Pedidos</a></li>';
                echo '<li><a href="relatorio.php">Relatório</a></li>';
                echo '<li><a href="cadastro.html">Cadastro Login</a></li>';
				echo '<li><a href="novoproduto.html">Cadastro Produto</a></li>';
            }
            ?>
            <li>
                <a href="buscarid.php">Status do Pedido</a>
            </li>
        </ul>
    </nav>
                <?php
            $isLoggedin = isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] === true;
            if ($isLoggedin) {
                echo '<li><a href="editarid.php">Editar</a></li>';
            }
            ?>
    <div class="formulario">
        <form method="GET" action="buscarid.php">

            <h1>Status do Pedido</h1>

            <?php
            if ($isLoggedin) {
                echo '<label for="idpedido">ID do pedido:</label>';
                echo '<input type="text" id="idpedido" name="idpedido" >';
                echo '<button type="submit">Pesquisar</button>';
            } ?>

            <label for="CPF_CNPJ">CPF_CNPJ:</label>
            <input type="text" id="CPF_CNPJ" name="CPF_CNPJ" >
            <button type="submit">Pesquisar</button>

        </form>
    </div>
    


    <div class="tabela">
        <link rel="stylesheet" href="StyleTabela.css">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Número do pedido</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                    <th>Data de Compra</th>
                    <th>Prazo</th>
                    <th>Situação</th>
                    <?php
                    if ($isLoggedin) {
                        echo '<th>Ação</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'conexao.php';

                if (isset($_GET['idpedido']) || isset($_GET['CPF_CNPJ'])) {
                    $idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : null;
                    $cpf_cnpj = isset($_GET['CPF_CNPJ']) ? $_GET['CPF_CNPJ'] : null;

                    // Utilize prepared statements para evitar injeção de SQL
                    if (isset($idpedido) && is_numeric($idpedido)) {
                        $sql = "SELECT * FROM tb_analisepedido WHERE CodApedido = ?";
                    } elseif (!empty($cpf_cnpj)) {
                        $sql = "SELECT * FROM tb_analisepedido WHERE CPF_CNPJ = ?";
                    } else {
                        exit; // Ou outra ação apropriada se as variáveis estiverem vazias
                    }

                    // Preparar a consulta
                    $stmt = mysqli_prepare($conn, $sql);

                    if ($stmt) {
                        if (isset($idpedido) && is_numeric($idpedido)) {
                            // Atribuir valores e executar a consulta para idpedido
                            mysqli_stmt_bind_param($stmt, "i", $idpedido);
                        } elseif (!empty($cpf_cnpj)) {
                            // Atribuir valores e executar a consulta para CPF_CNPJ
                            mysqli_stmt_bind_param($stmt, "s", $cpf_cnpj);
                        }

                        mysqli_stmt_execute($stmt);

                        $resultado = mysqli_stmt_get_result($stmt);

                        if ($resultado) {
                            if (mysqli_num_rows($resultado) > 0) {
                                // Adapte o loop para percorrer todas as linhas
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    echo '<tr>';
                                    echo '<td data-title="Clientes">' . $row['NomeCliente'] . '</td>';
                                    echo '<td data-title="Número do pedido">' . $row['CodApedido'] . '</td>';
                                    echo '<td data-title="Quantidade">' . $row['Quantidade'] . '</td>';
                                    echo '<td data-title="Valor Total">R$' . number_format($row['ValorTotal'], 2) . '</td>';
                                    echo '<td data-title="Data de Compra">' . $row['datacompra'] . '</td>';
                                    if (!empty($row['Prazo'])) {
                                        echo '<td data-title="Prazo">' . $row['Prazo'] . '</td>';
                                    } else {
                                        echo '<td data-title="Prazo">Prazo indefinido</td>';
                                    }

                                    echo '<td data-title="Situação">';
                                    if (!empty($row['status'])) {
                                        echo '<button>' . $row['status'] . '</button>';
                                    } else {
                                        echo '<button>Status indefinido</button>';
                                    }
                                    echo '</td>';

                                    if ($isLoggedin) {
                                        echo '<td data-title="Ação">';
                                        echo '<button><a style="text-decoration:none; color: #fff;" href="editarid.php?idpedido=' . $row['CodApedido'] . '">Editar</a></button>';
                                        echo '</td>';
                                    }

                                    echo '</tr>';
                                }
                            } else {
                                echo "Pedido não encontrado.";
                            }
                        } else {
                            echo "Erro na consulta: " . mysqli_error($conn);
                        }

                        mysqli_free_result($resultado);
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
