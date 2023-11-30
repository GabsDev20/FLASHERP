<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Cadastro de Usuário</title>

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

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Cadastro de Usuário</h2>

                            <?php
                            // Verificar se o formulário foi submetido
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Conexão com o banco de dados (ajuste as configurações conforme necessário)
                                $conexao = new mysqli("localhost", "root", "root", "flasherp");

                                if ($conexao->connect_error) {
                                    die("Erro na conexão: " . $conexao->connect_error);
                                }

                                // Obter dados do formulário
                                $nome = $_POST['nome'];
                                $email = $_POST['email'];
                                $telefone = $_POST['telefone'];
                                $cidade = $_POST['cidade'];
                                $estado = $_POST['estado'];
                                $endereco = $_POST['endereco'];
                                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Armazenar senha de forma segura

                                // Preparar e executar a consulta SQL
                                $sql = "INSERT INTO usuarios (nome, email, telefone, cidade, estado, endereco, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $conexao->prepare($sql);

                                if ($stmt) {
                                    $stmt->bind_param("sssssss", $nome, $email, $telefone, $cidade, $estado, $endereco, $senha);
                                    $stmt->execute();

                                    // Verificar se houve erro ao executar a consulta
                                    if ($stmt->error) {
                                        echo "Erro ao cadastrar usuário: " . $stmt->error;
                                    } else {
                                        echo "Usuário cadastrado com sucesso.";
                                    }

                                    // Fechar a declaração preparada
                                    $stmt->close();
                                } else {
                                    // Lidar com erro na preparação da consulta
                                    echo "Erro na preparação da consulta: " . $conexao->error;
                                }

                                // Fechar a conexão
                                $conexao->close();
                            }
                            ?>

                            <!-- Formulário de Cadastro de Usuário -->
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefone">Telefone:</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                                </div>
                                <div class="form-group">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <input type="text" class="form-control" id="estado" name="estado" required>
                                </div>
                                <div class="form-group">
                                    <label for="endereco">Endereço:</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha:</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4, jQuery, AdminLTE App -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
