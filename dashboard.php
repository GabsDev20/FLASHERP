<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .info-box {
            display: block;
            min-height: 90px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .info-box-icon {
            border: 1px solid #d2d6de;
            border-radius: 50%;
            font-size: 32px;
            line-height: 44px;
            text-align: center;
            width: 50px;
            height: 50px;
        }

        .info-box-content {
            padding: 0 10px;
            margin-left: 70px;
        }

        /* Estilos específicos para cada caixa de informação */
        .info-box-total-pedidos {
            background-color: #fff;
            border: 1px solid #d2d6de;
            border-radius: 5px;
        }

        .info-box-total-pedidos .info-box-icon {
            background-color: #28a745; /* Cor específica para Total de Pedidos */
        }

        .info-box-pedidos-aprovados {
            background-color: #fff;
            border: 1px solid #d2d6de;
            border-radius: 5px;
        }

        .info-box-pedidos-aprovados .info-box-icon {
            background-color: #success; /* Cor específica para Pedidos Aprovados */
        }

        /* Adicione estilos semelhantes para outras classes de caixas de informação */

    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">

                    <!-- Consulta ao banco de dados para obter informações -->
                    <?php
                    // Conectar ao banco de dados
                    $conexao = new mysqli("localhost", "root", "root", "flasherp");

                    // Verificar a conexão
                    if ($conexao->connect_error) {
                        die("Erro na conexão: " . $conexao->connect_error);
                    }

                    // Consulta para obter o total de pedidos
                    $sql_total_pedidos = "SELECT COUNT(*) AS total_pedidos FROM pedidos";
                    $resultado_total_pedidos = $conexao->query($sql_total_pedidos);

                    // Consulta para obter o total de pedidos aprovados
                    $sql_pedidos_aprovados = "SELECT COUNT(*) AS pedidos_aprovados FROM pedidos WHERE status = 'Aprovado'";
                    $resultado_pedidos_aprovados = $conexao->query($sql_pedidos_aprovados);

                    // Consulta para obter o total de pedidos pendentes
                    $sql_pedidos_pendentes = "SELECT COUNT(*) AS pedidos_pendentes FROM pedidos WHERE status = 'Pendente'";
                    $resultado_pedidos_pendentes = $conexao->query($sql_pedidos_pendentes);

                    // Consulta para obter o total de pedidos cancelados
                    $sql_pedidos_cancelados = "SELECT COUNT(*) AS pedidos_cancelados FROM pedidos WHERE status = 'Cancelado'";
                    $resultado_pedidos_cancelados = $conexao->query($sql_pedidos_cancelados);

                    // Consulta para obter o total de orçamentos pendentes
                    $sql_orcamento_pendente = "SELECT COUNT(*) AS orcamento_pendente FROM pedidos WHERE status = 'Orçamento Pendente'";
                    $resultado_orcamento_pendente = $conexao->query($sql_orcamento_pendente);

                    // Consulta para obter o total de pedidos em curso
                    $sql_pedidos_em_curso = "SELECT COUNT(*) AS pedidos_em_curso FROM pedidos WHERE status = 'Em Curso'";
                    $resultado_pedidos_em_curso = $conexao->query($sql_pedidos_em_curso);

                    // Consulta para obter o total de pedidos retirados
                    $sql_pedidos_retirados = "SELECT COUNT(*) AS pedidos_retirados FROM pedidos WHERE status = 'Retirado'";
                    $resultado_pedidos_retirados = $conexao->query($sql_pedidos_retirados);

                    // Consulta para obter o total de pedidos entregues
                    $sql_pedidos_entregues = "SELECT COUNT(*) AS pedidos_entregues FROM pedidos WHERE status = 'Entregue'";
                    $resultado_pedidos_entregues = $conexao->query($sql_pedidos_entregues);
                    

                    

                    // Verificar erros nas consultas
                    if (
                        $resultado_total_pedidos === false ||
                        $resultado_pedidos_aprovados === false ||
                        $resultado_pedidos_pendentes === false ||
                        $resultado_pedidos_cancelados === false ||
                        $resultado_orcamento_pendente === false ||
                        $resultado_pedidos_em_curso === false ||
                        $resultado_pedidos_retirados === false ||
                        $resultado_pedidos_entregues === false

                     

                    ) {
                        die("Erro nas consultas: " . $conexao->error);
                    }


                    // Obter o total de pedidos
                    $linha_total_pedidos = $resultado_total_pedidos->fetch_assoc();
                    $total_pedidos = $linha_total_pedidos['total_pedidos'];

                    // Obter o total de pedidos aprovados
                    $linha_pedidos_aprovados = $resultado_pedidos_aprovados->fetch_assoc();
                    $pedidos_aprovados = $linha_pedidos_aprovados['pedidos_aprovados'];

                    // Obter o total de pedidos pendentes
                    $linha_pedidos_pendentes = $resultado_pedidos_pendentes->fetch_assoc();
                    $pedidos_pendentes = $linha_pedidos_pendentes['pedidos_pendentes'];

                    // Obter o total de pedidos cancelados
                    $linha_pedidos_cancelados = $resultado_pedidos_cancelados->fetch_assoc();
                    $pedidos_cancelados = $linha_pedidos_cancelados['pedidos_cancelados'];

                    // Obter o total de orçamentos pendentes
                    $linha_orcamento_pendente = $resultado_orcamento_pendente->fetch_assoc();
                    $orcamento_pendente  = $linha_orcamento_pendente ['orcamento_pendente'];

                    // Obter o total de pedidos em curso
                    $linha_pedidos_em_curso = $resultado_pedidos_em_curso->fetch_assoc();
                    $pedidos_em_curso = $linha_pedidos_em_curso['pedidos_em_curso'];

                    // Obter o total de pedidos retirados
                    $linha_pedidos_retirados = $resultado_pedidos_retirados->fetch_assoc();
                    $pedidos_retirados = $linha_pedidos_retirados['pedidos_retirados'];

                    // Obter o total de pedidos entregues
                    $linha_pedidos_entregues = $resultado_pedidos_entregues->fetch_assoc();
                    $pedidos_entregues = $linha_pedidos_entregues['pedidos_entregues'];

                    // Exibir o total de pedidos e outros estados
                    ?>

                   <!-- Boxes de informações -->
<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total de Pedidos</span>
                <span class="info-box-number"><?php echo $total_pedidos; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pedidos Aprovados</span>
                <span class="info-box-number"><?php echo $pedidos_aprovados; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pedidos Pendentes</span>
                <span class="info-box-number"><?php echo $pedidos_pendentes; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-times"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pedidos Cancelados</span>
                <span class="info-box-number"><?php echo $pedidos_cancelados; ?></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-money-bill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sem Orçamento</span>
                <span class="info-box-number"><?php echo $orcamento_pendente; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-secondary"><i class="fas fa-hourglass-half"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Em Curso</span>
                <span class="info-box-number"><?php echo $pedidos_em_curso; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fas fa-truck"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Retirados</span>
                <span class="info-box-number"><?php echo $pedidos_retirados; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Entregues</span>
                <span class="info-box-number"><?php echo $pedidos_entregues; ?></span>
            </div>
        </div>
    </div>
</div>
                    <!-- Gráficos -->
                    <div class="row">
                        <!-- Gráfico de Pizza (Total de Pedidos) -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total de Pedidos</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="totalPedidosChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Gráfico de Barras (Status dos Pedidos) -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Status dos Pedidos</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusPedidosChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Novos Gráficos (Em Curso, Retirado, Entregue) -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Em Curso</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="emCursoChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pedidos Retirados</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="retiradoChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pedidos Entregues</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="entregueChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                                <!-- Script para os gráficos -->
<script>
                        // Gráfico de Pizza (Total de Pedidos)
                        var totalPedidosChart = new Chart(document.getElementById('totalPedidosChart').getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Aprovados', 'Pendentes', 'Cancelados', 'Orçamento Pendente'],
                                datasets: [{
                                    data: [<?php echo $pedidos_aprovados; ?>, <?php echo $pedidos_pendentes; ?>, <?php echo $pedidos_cancelados; ?>, <?php echo isset($orcamento_pendente) ? $orcamento_pendente : 0; ?>],
                                    backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#007bff'], // Adicionando a cor azul
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                }
                            }
                        });

                        // Gráfico de Barras (Status dos Pedidos)
                        var statusPedidosChart = new Chart(document.getElementById('statusPedidosChart').getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: ['Aprovados', 'Pendentes', 'Cancelados', 'Orçamento Pendente'],
                                datasets: [{
                                    label: 'Quantidade',
                                    data: [<?php echo $pedidos_aprovados; ?>, <?php echo $pedidos_pendentes; ?>, <?php echo $pedidos_cancelados; ?>, <?php echo $orcamento_pendente; ?>],
                                    backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#007bff'], // Adicionando a cor azul
                                }]
                            },
                            options: {
                                legend: {
                                    display: false,
                                }
                            }
                        });

                        // Novos Gráficos (Em Curso, Retirado, Entregue)
                        var emCursoChart = new Chart(document.getElementById('emCursoChart').getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Em Curso', 'Outros'],
                                datasets: [{
                                    data: [<?php echo $pedidos_em_curso; ?>, <?php echo $total_pedidos - $pedidos_em_curso; ?>],
                                    backgroundColor: ['#17a2b8', '#e9ecef'],
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                }
                            }
                        });

                        var retiradoChart = new Chart(document.getElementById('retiradoChart').getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Retirado', 'Outros'],
                                datasets: [{
                                    data: [<?php echo $pedidos_retirados; ?>, <?php echo $total_pedidos - $pedidos_retirados; ?>],
                                    backgroundColor: ['#007bff', '#e9ecef'],
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                }
                            }
                        });

                        var entregueChart = new Chart(document.getElementById('entregueChart').getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Entregue', 'Outros'],
                                datasets: [{
                                    data: [<?php echo $pedidos_entregues; ?>, <?php echo $total_pedidos - $pedidos_entregues; ?>],
                                    backgroundColor: ['#28a745', '#e9ecef'],
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                }
                            }
                        });
                    </script>

                </div>
            </div>
            <!-- /.content -->
        </div>  
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.1.0
            </div>
            <strong>&copy; 2023 <a href="sistema.php">ERPFLASH</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
