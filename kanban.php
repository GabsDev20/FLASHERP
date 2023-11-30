<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Quadro Kanban</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Custom CSS -->
    <style>
        .kanban-container {
            display: flex;
            justify-content: space-around;
            margin: 20px;
        }

        .kanban-column {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            margin: 0 10px;
        }

        .kanban-column h3 {
            text-align: center;
            margin-bottom: 15px;
        }

        .kanban-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: grab;
            transition: background-color 0.3s ease;
        }

        .kanban-card:hover {
            background-color: #e8f4fc;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
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
                            <h2 class="text-center mb-4">Quadro Kanban - Pedidos</h2>

                            <div class="kanban-container">
                                <!-- Coluna Aprovados -->
                                <div class="kanban-column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Aprovados</h3>
                                        </div>
                                        <div class="card-body kanban-column" id="aprovados-column" ondrop="drop(event, 'Aprovado')" ondragover="allowDrop(event)">
                                            <!-- Cartões de pedidos aprovados aparecem aqui -->
                                            <?php
                                            // Conexão com o banco de dados
                                            $conexao = new mysqli("localhost", "root", "root", "flasherp");

                                            if ($conexao->connect_error) {
                                                die("Erro na conexão: " . $conexao->connect_error);
                                            }

                                            // Consultar pedidos aprovados
                                            $sql = "SELECT * FROM pedidos WHERE status = 'Aprovado'";
                                            $result = $conexao->query($sql);

                                            // Exibir cartões para pedidos aprovados
                                            while ($row = $result->fetch_assoc()) :
                                            ?>
                                                <div class="kanban-card" id="card-<?php echo $row['id']; ?>" draggable="true" ondragstart="drag(event)">
                                                    <input type="hidden" class="status" value="<?php echo $row['status']; ?>">
                                                    <strong>Cliente:</strong> <?php echo htmlspecialchars($row['cliente']); ?><br>
                                                    <strong>Produto:</strong> <?php echo htmlspecialchars($row['produto']); ?><br>
                                                    <strong>Data de Entrega:</strong> <?php echo $row['dateEntrega']; ?>
                                                </div>
                                            <?php endwhile;

                                            // Fechar a conexão
                                            $conexao->close();
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coluna Em Curso -->
                                <div class="kanban-column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Em Curso</h3>
                                        </div>
                                        <div class="card-body kanban-column" id="em-curso-column" ondrop="drop(event, 'Em Curso')" ondragover="allowDrop(event)">
                                            <!-- Cards de pedidos em curso devem aparecer aqui -->
                                            <?php
                                            // Conexão com o banco de dados
                                            $conexao = new mysqli("localhost", "root", "root", "flasherp");

                                            if ($conexao->connect_error) {
                                                die("Erro na conexão: " . $conexao->connect_error);
                                            }

                                            // Consultar pedidos Em Curso
                                            $sql = "SELECT * FROM pedidos WHERE status = 'Em Curso'";
                                            $result = $conexao->query($sql);

                                            // Exibir cartões para pedidos Em Curso
                                            while ($row = $result->fetch_assoc()) :
                                            ?>
                                                <div class="kanban-card" id="card-<?php echo $row['id']; ?>" draggable="true" ondragstart="drag(event)">
                                                    <input type="hidden" class="status" value="<?php echo $row['status']; ?>">
                                                    <strong>Cliente:</strong> <?php echo htmlspecialchars($row['cliente']); ?><br>
                                                    <strong>Produto:</strong> <?php echo htmlspecialchars($row['produto']); ?><br>
                                                    <strong>Data de Entrega:</strong> <?php echo $row['dateEntrega']; ?>
                                                </div>
                                            <?php endwhile;

                                            // Fechar a conexão
                                            $conexao->close();
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coluna Retirados -->
                                <div class="kanban-column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Retirados</h3>
                                        </div>
                                        <div class="card-body kanban-column" id="retirados-column" ondrop="drop(event, 'Retirado')" ondragover="allowDrop(event)">
                                            <!-- Cards de pedidos retirados devem aparecer aqui -->
                                            <?php
            // Conexão com o banco de dados
            $conexao = new mysqli("localhost", "root", "root", "flasherp");

            if ($conexao->connect_error) {
                die("Erro na conexão: " . $conexao->connect_error);
            }

            // Consultar pedidos retirados
            $sql = "SELECT * FROM pedidos WHERE status = 'Retirado'";
            $result = $conexao->query($sql);

            // Exibir cartões para pedidos retirados
            while ($row = $result->fetch_assoc()) :
            ?>
                <div class="kanban-card" id="card-<?php echo $row['id']; ?>" draggable="true" ondragstart="drag(event)">
                    <input type="hidden" class="status" value="<?php echo $row['status']; ?>">
                    <strong>Cliente:</strong> <?php echo htmlspecialchars($row['cliente']); ?><br>
                    <strong>Produto:</strong> <?php echo htmlspecialchars($row['produto']); ?><br>
                    <strong>Data de Entrega:</strong> <?php echo $row['dateEntrega']; ?>
                </div>
            <?php endwhile;

            // Fechar a conexão
            $conexao->close();
            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coluna Entregues -->
                                <div class="kanban-column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Entregues</h3>
                                        </div>
                                        <div class="card-body kanban-column" id="entregues-column" ondrop="drop(event, 'Entregue')" ondragover="allowDrop(event)">
                                            <!-- Cards de pedidos entregues devem aparecer aqui -->
                                            <?php
                                            // Conexão com o banco de dados
                                            $conexao = new mysqli("localhost", "root", "root", "flasherp");

                                            if ($conexao->connect_error) {
                                                die("Erro na conexão: " . $conexao->connect_error);
                                            }

                                            // Consultar pedidos Entregues
                                            $sql = "SELECT * FROM pedidos WHERE status = 'Entregue'";
                                            $result = $conexao->query($sql);
                                           

                                            // Fechar a conexão
                                            $conexao->close();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <!-- Kanban JS -->
        <script>
    function allowDrop(event) {
        event.preventDefault();
    }

    function drag(event) {
        event.dataTransfer.setData("text", event.target.id);
    }

    function drop(event, novoStatus) {
        event.preventDefault();
        var data = event.dataTransfer.getData("text");
        var draggedElement = document.getElementById(data);
        var targetColumn = event.target.closest('.kanban-column');

        if (novoStatus === 'Entregue') {
            // Remover o cartão da coluna "Entregues"
            draggedElement.remove();
        } else {
            targetColumn.appendChild(draggedElement);
        }

        // Obter o ID do pedido do cartão
        var pedidoId = data.replace("card-", "");

        // Atualizar status no cartão
        $(draggedElement).find('.status').val(novoStatus);

        // Atualizar status no banco de dados
        atualizarStatus(pedidoId, novoStatus);
    }

    function atualizarStatus(pedidoId, novoStatus) {
        // Fazer uma requisição AJAX para atualizar o status no servidor
        fetch('atualizar_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + pedidoId + '&novoStatus=' + novoStatus,
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Erro ao atualizar o status:', error);
            });
    }
</script>
    </div>
</body>

</html>
