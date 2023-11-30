<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Consulta de Pedidos</title>

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
            text-align: left;
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

        canvas {
            margin-top: 20px;
        }

        /* Adicionado para alinhar as datas na mesma linha */
        th.date,
        td.date {
            white-space: nowrap;
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
                            <h2>Aprovação de Pedidos</h2>

                            <?php
                            // Conexão com o banco de dados
                            $conexao = new mysqli("localhost", "root", "root", "flasherp");

                            if ($conexao->connect_error) {
                                die("Erro na conexão: " . $conexao->connect_error);
                            }

                            // Verificar se o formulário foi submetido para alterar o status
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                if (isset($_POST['acao']) && isset($_POST['pedido_id'])) {
                                    $acao = $_POST['acao'];
                                    $pedido_id = $_POST['pedido_id'];

                                    // Verificar se a ação é válida
                                    if (in_array($acao, ['aprovar', 'cancelar'])) {
                                        // Aprovar ou cancelar pedido
                                        $status = ($acao == 'aprovar') ? 'Aprovado' : 'Cancelado';

                                        // Utilizar uma consulta preparada para evitar SQL injection
                                        $sql = "UPDATE pedidos SET status = ? WHERE id = ?";
                                        $stmt = $conexao->prepare($sql);

                                        if ($stmt) {
                                            $stmt->bind_param("si", $status, $pedido_id);
                                            $stmt->execute();

                                            // Fechar a declaração preparada
                                            $stmt->close();
                                        } else {
                                            // Lidar com erro na preparação da consulta
                                            echo "Erro na preparação da consulta: " . $conexao->error;
                                        }
                                    } else {
                                        // Ação inválida, lidar com isso adequadamente
                                        echo "Ação inválida.";
                                    }
                                }
                            }

                            // Consultar pedidos pendentes
                            $sql = "SELECT * FROM pedidos WHERE status = 'Pendente'";
                            $result = $conexao->query($sql);

                            // Fechar a conexão
                            $conexao->close();

                            // Verificar se há pedidos pendentes
                            if ($result->num_rows > 0) {
                            ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome do Cliente</th>
                                            <th>Endereço de Retirada</th>
                                            <th class="date">Data de Retirada</th>
                                            <th>Endereço de Entrega</th>
                                            <th class="date">Data de Entrega</th>
                                            <th>Produto</th>
                                            <th>Orçamento</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                                                <td><?php echo htmlspecialchars($row['enderecoRetirada']); ?></td>
                                                <td class="date"><?php echo $row['dateRetirada']; ?></td>
                                                <td><?php echo htmlspecialchars($row['enderecoEntrega']); ?></td>
                                                <td class="date"><?php echo $row['dateEntrega']; ?></td>
                                                <td><?php echo htmlspecialchars($row['produto']); ?></td>
                                                <td><?php echo $row['valorOrcamento']; ?></td>

                                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 'Pendente') : ?>
                                                        <form method="post" action="aprova_pedido.php">
                                                            <input type="hidden" name="acao" value="aprovar">
                                                            <input type="hidden" name="pedido_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="btn btn-success mb-2" name="submit">Aprovar</button>
                                                        </form>
                                                        <form method="post" action="aprova_pedido.php">
                                                            <input type="hidden" name="acao" value="cancelar">
                                                            <input type="hidden" name="pedido_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="btn btn-danger" name="submit">Cancelar</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo "<p>Nenhum pedido pendente encontrado.</p>";
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
