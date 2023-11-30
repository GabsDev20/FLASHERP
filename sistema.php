<?php
session_start();
include_once('config.php');
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['email'];
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM usuarios ORDER BY id DESC";
}
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE Example</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
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
                <title>SISTEMA FLASHERP</title>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text">
                        Bem vindo: <?php echo $logado; ?>
                    </span>
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Página Inicial</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Add your content here -->
                    <div id="banner">
                        <img src="fondo.jpg" alt="Transportadora Banner" class="img-fluid">
                    </div>

                    <div id="services" class="mt-5">
                        <h2>Nossos Serviços</h2>
                        <p>Oferecemos diversos tipos de serviço, como transporte de cargas de grande porte, cargas frigoríficas,
                            cargas vivas, cargas perigosas, entre outras.</p>
                        <!-- Adicione mais informações sobre seus serviços aqui -->
                    </div>

                    <div id="tracking" class="mt-5">
                        <h2>Rastreamento de Cargas</h2>
                        <form>
                            <div class="form-group">
                                <label for="trackingNumber">Número de Rastreamento:</label>
                                <input type="text" class="form-control" id="trackingNumber" name="trackingNumber"
                                    placeholder="Digite o número de rastreamento">
                            </div>
                            <button type="submit" class="btn btn-primary">Rastrear</button>
                        </form>
                    </div>

                    <div id="contact" class="mt-5">
                        <h2>Entre em Contato</h2>
                        <p>Preencha o formulário abaixo para entrar em contato conosco:</p>
                        <form>
                            <!-- Adicione campos de formulário, como nome, e-mail, mensagem, etc. -->
                            <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
         
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
