<?php
// Conexão com o banco de dados
$conexao = new mysqli("localhost", "root", "root", "flasherp");

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verificar se o formulário foi submetido para incluir orçamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'], $_POST['pedido_id'], $_POST['valor_orcamento'])) {
        $acao = $_POST['acao'];
        $pedido_id = $_POST['pedido_id'];
        $valor_orcamento = $_POST['valor_orcamento'];

        // Verificar se a ação é válida
        if ($acao == 'incluir_orcamento') {
            // Incluir orçamento no pedido
            $sql = "UPDATE pedidos SET valorOrcamento = ?, status = 'Pendente' WHERE id = ?";
            $stmt = $conexao->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("di", $valor_orcamento, $pedido_id);
                $stmt->execute();

                // Fechar a declaração preparada
                $stmt->close();
            } else {
                // Lidar com erro na preparação da consulta
                echo "Erro na preparação da consulta: " . $conexao->error;
            }
        }
    }
}

// Consultar pedidos com status "Orçamento Pendente"
$sql = "SELECT * FROM pedidos WHERE status = 'Orçamento Pendente'";
$result = $conexao->query($sql);

// Fechar a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Consulta de Pedidos (Orçamento Pendente)</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Bootstrap Admin CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .content-wrapper {
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center; /* Centralizar o texto */
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .export-btn {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="number"] {
            width: 80px;
        }

        /* Adicionando estilo para ajustar o botão */
        .incluir-btn {
            width: auto; /* Largura automática com base no conteúdo */
        }

        /* Ajuste para tornar o campo de entrada visível */
        .input-group {
            width: auto;
        }

        .input-group-append {
            display: flex;
        }

        .form-control {
            width: 100px; /* Ajuste a largura conforme necessário */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <a href="sistema.php" class="brand-link">
                <img src="Logo.png" alt="Logo da Transportadora" style="opacity: .8; width: 180px;">
            </a>
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="sistema.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pedido.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Cadastrar Pedidos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="orcamento_pedido.php" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Incluir Orçamentos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="aprova_pedido.php" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>Aprovar Pedidos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="consulta.php" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>Consulta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kanban.php" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>Quadro Kanban</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cadastro_usuario.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cadastrar Usuário</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Contato</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">Consulta de Pedidos (Orçamento Pendente)</h2>

                            <?php
                            // Verificar se há pedidos com status "Orçamento Pendente"
                            if ($result->num_rows > 0) {
                            ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome do Cliente</th>
                                            <th>Endereço de Retirada</th>
                                            <th>Data de Retirada</th>
                                            <th>Endereço de Entrega</th>
                                            <th>Data de Entrega</th>
                                            <th>Produto</th>
                                            <th>Peso</th>
                                            <th>Cubagem</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                                                <td><?php echo htmlspecialchars($row['enderecoRetirada']); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($row['dateRetirada'])); ?></td>
                                                <td><?php echo htmlspecialchars($row['enderecoEntrega']); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($row['dateEntrega'])); ?></td>
                                                <td><?php echo htmlspecialchars($row['produto']); ?></td>
                                                <td><?php echo $row['peso']; ?></td>
                                                <td><?php echo $row['cubagem']; ?></td>
                                                <td>
        <form method="post" action="orcamento_pedido.php">
            <input type="hidden" name="acao" value="incluir_orcamento">
            <input type="hidden" name="pedido_id" value="<?php echo $row['id']; ?>">
            <div class="input-group">
                <input type="number" name="valor_orcamento" class="form-control" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success btn-sm">Incluir</button>
                </div>
            </div>
        </form>
    </td>
</tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo "<p class='text-center'>Nenhum pedido com status 'Orçamento Pendente' encontrado.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.1.0
            </div>
            <strong>&copy; 2023 <a href="sistema.php">FlashERP</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
