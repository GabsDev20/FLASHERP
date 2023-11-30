<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pedidos</title>

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
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
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
                        <li class="nav-item">
                            <a href="cadastro_usuario.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cadastrar Usuário</p>
                            </a>
                        </li>
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
                            <h1 class="m-0">Consulta de Pedidos</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Formulário de filtro -->
                    <form method="post">
                        <div class="form-group">
                            <label for="filtroCliente">Filtrar por Cliente:</label>
                            <input type="text" class="form-control" id="filtroCliente" name="filtroCliente">
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <?php
        // Conectar ao banco de dados
        $conexao = new mysqli("localhost", "root", "root", "flasherp");

        // Verificar a conexão
        if ($conexao->connect_error) {
            die("Erro na conexão: " . $conexao->connect_error);
        }

        // Inicializar o filtro
        $filtroCliente = "";

        // Verificar se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obter o valor do filtro do formulário
            $filtroCliente = $_POST["filtroCliente"];
        }

        // Consulta SQL com filtro
        $sql = "SELECT * FROM pedidos";

        // Adicionar o filtro se um cliente for fornecido
        if (!empty($filtroCliente)) {
            $sql .= " WHERE cliente LIKE '%$filtroCliente%'";
        }

        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            // Exibir os resultados em uma tabela
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Contato do Cliente</th>
                        <th>Endereço de Retirada</th>
                        <th>Data de Retirada</th>
                        <th>Endereço de Entrega</th>
                        <th>Data de Entrega</th>
                        <th>Produto</th>
                        <th>Peso</th>
                        <th>Cubagem</th>
                        <th>Status</th>
                    </tr>";

            while ($linha = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$linha['id']}</td>
                        <td>{$linha['cliente']}</td>
                        <td>{$linha['contatoCliente']}</td>
                        <td>{$linha['enderecoRetirada']}</td>
                        <td>{$linha['dateRetirada']}</td>
                        <td>{$linha['enderecoEntrega']}</td>
                        <td>{$linha['dateEntrega']}</td>
                        <td>{$linha['produto']}</td>
                        <td>{$linha['peso']}</td>
                        <td>{$linha['cubagem']}</td>
                        <td>{$linha['status']}</td>
                    </tr>";
            }

            echo "</table>";

            // Adicionar botão de exportação para CSV
            echo "<button class='export-btn' onclick='exportToCSV()'>Exportar para CSV</button>";
        } else {
            echo "Nenhum resultado encontrado.";
        }

        // Fechar a conexão
        $conexao->close();
    ?>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <script>
    function exportToCSV() {
        // Obter a tabela HTML
        var table = document.querySelector('table');
        // Criar um objeto Blob contendo o texto da tabela em formato CSV
        var csv = [];
        var rows = table.querySelectorAll('tr');
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            csv.push(row.join(','));
        }
        var csvContent = csv.join('\n');
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Criar um link para download
        var link = document.createElement('a');
        if (link.download !== undefined) { // Verificar se o navegador suporta o atributo 'download'
            var url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'consulta_pedidos.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            alert('Seu navegador não suporta o download direto. Por favor, copie os dados manualmente.');
        }
    }
</script>

</body>
</html>
