<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #0075E2;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #0075E2; /* Cor azul do fundo */
            width: 300px;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
            background: #0075E2; /* Cor azul do fundo */
            color: white;
        }

        .inputSubmit {
            background-color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: #0075E2; /* Cor azul do fundo */
            font-size: 15px;
        }

        .inputSubmit:hover {
            background-color: #0075E2; /* Cor azul do fundo */
            color: white;
            cursor: pointer;
        }

        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: transparent;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s; /* Adicionado para suavizar a transição */
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
    </style>
</head>
<body>
    <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <div class="login-box">
        <h1>Login</h1>
        <form action="testLogin.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <input class="inputSubmit btn btn-primary" type="submit" name="submit" value="Enviar">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
