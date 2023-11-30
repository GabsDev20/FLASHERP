<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Fonts - Quicksand -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #0075E2;
            text-align: center;
            color: white;
        }

        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white; /* Altera a cor de fundo para branco */
            padding: 30px;
            border-radius: 10px;
        }

        .box img {
            width: 250px; /* Aumenta o tamanho da logo */
            height: auto;
            margin-bottom: 20px;
        }

        .box a {
            text-decoration: none;
            color: #0075E2; /* Altera a cor do texto para azul #0075E2 */
            border: 3px solid #0075E2; /* Altera a cor da borda para azul #0075E2 */
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 1rem;
            display: block;
            margin-bottom: 10px;
            background-color: white; /* Altera a cor de fundo para branco */
        }

        .box a:hover {
            background-color: #0075E2; /* Altera a cor de fundo para azul #0075E2 */
            color: white; /* Altera a cor do texto para branco ao passar o mouse */
        }

        .welcome-header {
            font-family: 'Quicksand', sans-serif;
            font-size: 3rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="box">
        <img src="Logo.png" alt="Logo da Transportadora">
        <a href="login.php">Login</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
