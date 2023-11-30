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
    <title>SISTEMA FLASHERP</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
       <style>
    body {
        font-family: 'Source Sans Pro', sans-serif;
        margin: 0;
        padding: 0;
    }

   
</style>

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

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Cadastro de Pedidos</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Add your content here -->

                    <!-- Seu formulário -->
                    <form action="Pedidos.php" method="post" class="mt-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cliente">Nome do Cliente:</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="contatoCliente">Contato do Cliente:</label>
                                    <input type="text" class="form-control" id="contatoCliente" name="contatoCliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="enderecoRetirada">Endereço de Retirada:</label>
                                    <textarea class="form-control" id="enderecoRetirada" name="enderecoRetirada" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="dateRetirada">Data de retirada:</label>
                                    <input type="date" class="form-control" id="dateRetirada" name="dateRetirada" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="enderecoEntrega">Endereço de entrega:</label>
                                    <input type="text" class="form-control" id="enderecoEntrega" name="enderecoEntrega" required>
                                </div>
                                <div class="form-group">
                                    <label for="dateEntrega">Data de entrega:</label>
                                    <input type="date" class="form-control" id="dateEntrega" name="dateEntrega" required>
                                </div>
                                <div class="form-group">
                                    <label for="produto">Produto:</label>
                                    <input type="text" class="form-control" id="produto" name="produto" required>
                                </div>
                                <div class="form-group">
                                    <label for="peso">Peso (kg):</label>
                                    <input type="text" class="form-control" id="peso" name="peso" required>
                                </div>
                                <div class="form-group">
                                    <label for="cubagem">Cubagem (m3):</label>
                                    <input type="text" class="form-control" id="cubagem" name="cubagem" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="enviarWhatsapp()">Enviar Pedido</button>
                        <script>
    async function enviarWhatsapp() {
        // Obtenha os valores dos campos do formulário
        var cliente = document.getElementById("cliente").value;
        var contatoCliente = document.getElementById("contatoCliente").value;
        var endere_retirada = document.getElementById("enderecoRetirada").value;
        var data_retirada = new Date(document.getElementById("dateRetirada").value + 'T00:00:00');
        var endere_entrega = document.getElementById("enderecoEntrega").value;
        var data_entrega = new Date(document.getElementById("dateEntrega").value + 'T00:00:00');
        var produto = document.getElementById("produto").value;
        var peso = document.getElementById("peso").value;
        var cubagem = document.getElementById("cubagem").value;
        var numeroTelefone = "5511969563897";

        var data_retirada_formatada = data_retirada.toLocaleDateString('pt-BR');
        var data_entrega_formatada = data_entrega.toLocaleDateString('pt-BR');

        var mensagem = "Olá, um novo pedido foi gerado no seu sistema. Seguem as informações:\n" + "\n" +
            "Cliente: " + cliente + "\n" +
            "Contato cliente: " + contatoCliente + "\n" +
            "Endereço de Retirada: " + endere_retirada + "\n" +
            "Data de Retirada: " + data_retirada_formatada + "\n" +
            "Endereço de Entrega: " + endere_entrega + "\n" +
            "Data de Entrega: " + data_entrega_formatada + "\n" +
            "Produto: " + produto + "\n" +
            "Peso: " + peso + "kg" + "\n" +
            "Cubagem: " + cubagem + "m³";

        // Use a função fetch para enviar os dados do formulário para o servidor
        try {
            await fetch('testePedido.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'cliente': cliente,
                    'contatoCliente': contatoCliente,
                    'enderecoRetirada': endere_retirada,
                    'dateRetirada': data_retirada.toISOString(),
                    'enderecoEntrega': endere_entrega,
                    'dateEntrega': data_entrega.toISOString(),
                    'produto': produto,
                    'peso': peso,
                    'cubagem': cubagem,
                }),
            });

            // Redirecione para o link do WhatsApp após o envio bem-sucedido
            var linkWhatsapp = "https://wa.me/" + numeroTelefone + "?text=" + encodeURIComponent(mensagem);
            window.location.href = linkWhatsapp;
        } catch (error) {
            console.error('Erro ao enviar os dados do formulário:', error);
        }
    }
                    

</script>
                    </form>
                    <!-- Fim do formulário -->

                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              
            </div>
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