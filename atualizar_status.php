<?php
// Conexão com o banco de dados
$conexao = new mysqli("localhost", "root", "root", "flasherp");

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verificar se o formulário foi submetido para mover o pedido entre as colunas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['novoStatus'])) {
        $pedido_id = $_POST['id'];
        $novo_status = $_POST['novoStatus'];

        // Atualizar o status no banco de dados
        $sql = "UPDATE pedidos SET status = '$novo_status' WHERE id = $pedido_id";

        if ($conexao->query($sql) === TRUE) {
            echo "Status atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o status: " . $conexao->error;
        }
    } else {
        // Parâmetros inválidos, lidar com isso adequadamente
        echo "Parâmetros inválidos.";
    }
}

// Fechar a conexão
$conexao->close();
?>
