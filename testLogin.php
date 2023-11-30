<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['senha'];

        // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
        if (password_verify($senha, $hashed_password)) {
            $_SESSION['email'] = $email;
            header('Location: sistema.php');
        } else {
            // Senha incorreta
            header('Location: login.php');
        }
    } else {
        // Usuário não encontrado
        header('Location: login.php');
    }
} else {
    // Não acessa
    header('Location: login.php');
}
?>