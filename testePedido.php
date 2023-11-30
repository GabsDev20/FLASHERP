<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Fazer Pedido com Entrega</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        #order {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10.344a6hpx 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 2%;
        }

    </style>
</head>
    </style>
<body>
    <header>
        <h1>FLASHEXPRESS TRANSPORTADORA LTDA.</h1>
        <nav>
            <ul>
                <img src="Logo-1.png" image-align = "left" alt="Logo da Transportadora" class="logo"> 
                <li><a href="sistema.php">Home</a></li>
                <li><a href="#">Serviços</a></li>
                <li><a href="#">Relatórios</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </nav>
    </header>
    <h2> SOLICITAÇÃO DE TRANSPORTES</h2>
    
    <form id="submitForm" action="testePedido.php" method="post">
        <label for="cliente">Nome do Cliente:</label>
        <input type="text" id="cliente" name="cliente" required>

        <label for="cliente">Contato do Cliente:</label>
        <input type="text" id="contatoCliente" name="contatoCliente" required>

        <label for="endereco">Endereço de Retirada:</label>
        <textarea id="enderecoRetirada" name="enderecoRetirada" required></textarea>

        <label for="dateRetirada">Data de retirada:</label>
        <input type="date" id="dateRetirada" name="dateRetirada" required>

        <label for="enderecoEntrega">Endereço de entrega:</label>
        <input type="text" id="enderecoEntrega" name="enderecoEntrega" required>

        <label for="dateEntrega">Data de entrega:</label>
        <input type="date" id="dateEntrega" name="dateEntrega" required>

        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="produto" required>

        <label for="peso">Peso (kg):</label>
        <input type="text" id="peso" name="peso" required>

        <label for="cubagem">Cubagem (m3):</label>
        <input type="text" id="cubagem" name="cubagem" required>


        <button type="button" id="submit" onclick="enviarWhatsapp()" class="centralizado">Enviar Pedido</button>
        
            <script>
                function enviarWhatsapp() {
                // Obtenha os valores dos campos do formulário
                    var cliente = document.getElementById("cliente").value; // Obtenha o valor do campo senderCliente
                    var contatoCliente = document.getElementById("contatoCliente").value; // Obtenha o valor do campo contatoCliente
                    var endere_retirada = document.getElementById("enderecoRetirada").value; // Obtenha o valor do campo senderAddress
                    var data_retirada = new Date(document.getElementById("dateRetirada").value + 'T00:00:00'); // Ajuste para meia-noite
                    var endere_entrega = document.getElementById("enderecoEntrega").value; //Obtenha o valor do campo de recipientAddress
                    var data_entrega = new Date(document.getElementById("dateRetirada").value + 'T00:00:00'); // Ajuste para meia-noite
                    var produto = document.getElementById("produto").value; //Obtenha o valor do campo product
                    var peso = document.getElementById("peso").value; //Obtenha o valor do campo packageWeight
                    var cubagem = document.getElementById("cubagem").value; //Obtenha o valor do campo packageM3
                    var numeroTelefone = "5511969563897"; // Substitua pelo número de telefone desejado

                    // Formate as datas como "dia/mes/ano"
                    var data_retirada_formatada = data_retirada.toLocaleDateString('pt-BR');
                    var data_entrega_formatada = data_entrega.toLocaleDateString('pt-BR');

                    // Construa a mensagem formatada
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

                    // Crie o link do WhatsApp
                    var linkWhatsapp = "https://wa.me/" + numeroTelefone + "?text=" + encodeURIComponent(mensagem);

                    // Abra o link no WhatsApp
                    window.location.href = linkWhatsapp;

                    document.getElementById("submitForm").submit();

                    return false;
                }
            </script>



         
    </form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações do banco de dados
    $servername = "localhost"; // "localhost" em minúsculas
    $username = "root";
    $password = "root";
    $dbname = "flasherp";

    // Dados do formulário
    $cliente = $_POST["cliente"];
    $contatoCliente = $_POST['contatoCliente'];
    $enderecoRetirada = $_POST["enderecoRetirada"];
    $dateRetirada = $_POST['dateRetirada'];
    $enderecoEntrega = $_POST["enderecoEntrega"];
    $dateEntrega = $_POST['dateEntrega'];
    $produto = $_POST["produto"];
    $peso = $_POST["peso"];
    $cubagem = $_POST["cubagem"];

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Cria a tabela se ela não existir
    $criarTabela = "CREATE TABLE IF NOT EXISTS pedidos (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        cliente VARCHAR(255) NOT NULL,
                        contatoCliente TEXT NOT NULL,
                        enderecoRetirada TEXT NOT NULL,
                        dateRetirada DATE NOT NULL,
                        enderecoEntrega TEXT NOT NULL,
                        dateEntrega DATE NOT NULL,
                        produto VARCHAR(255) NOT NULL,
                        peso VARCHAR(255) NOT NULL,
                        cubagem VARCHAR(255) NOT NULL
                    )";
    if ($conn->query($criarTabela) === FALSE) {
        echo "Erro ao criar tabela: " . $conn->error;
    }

    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO pedidos (cliente, contatoCliente, enderecoRetirada, dateRetirada, enderecoEntrega, dateEntrega, produto, peso, cubagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Verifica se a preparação foi bem-sucedida
    if ($stmt === FALSE) {
        echo "Erro ao preparar a consulta: " . $conn->error;
    } else {
        // Bind dos parâmetros e executa a query
        $stmt->bind_param("sssssssss", $cliente, $contatoCliente, $enderecoRetirada, $dateRetirada, $enderecoEntrega, $dateEntrega, $produto, $peso, $cubagem);

        if ($stmt->execute()) {
            echo "Pedido enviado com sucesso";

            // Redireciona para a página desejada após o pedido
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao enviar pedido: " . $stmt->error;
        }

        // Fecha a conexão com o banco de dados
        $stmt->close();
    }

    $conn->close();
}
?>
