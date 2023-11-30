<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0075E2;
            color: #0075E2;
        }

        .box {
            color: #0075E2;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            width: 80%;
            max-width: 500px;
            margin: 50px auto;
        }

        fieldset {
            border: 3px solid #0075E2;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        legend {
            border: 1px solid #0075E2;
            padding: 10px;
            text-align: center;
            background-color: #0075E2;
            border-radius: 8px;
            color: white;
            margin-bottom: 20px;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid #0075E2;
            outline: none;
            color: #0075E2;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus~.labelInput,
        .inputUser:valid~.labelInput {
            top: -20px;
            font-size: 12px;
            color: #0075E2;
        }

        #submit {
            background-color: #0075E2;
            color: white;
            width: 100%;
            border: none;
            padding: 15px;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:hover {
            background-color: #0075E2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="formulario.php" method="POST">
                <legend><b>Fórmulário de Clientes</b></legend>
                <fieldset>
                    <div class="form-group">
                        <label for="nome_empresa">Nome da Empresa</label>
                        <input type="text" class="form-control inputUser" id="nome_empresa" name="nome_empresa" required>
                    </div>
                    <div class="form-group">
                        <label for="cnpj_cpf">CNPJ ou CPF</label>
                        <input type="text" class="form-control inputUser" id="cnpj_cpf" name="cnpj_cpf" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control inputUser" id="senha" name="senha" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control inputUser" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control inputUser" id="telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control inputUser" id="cidade" name="cidade" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control inputUser" id="estado" name="estado" required>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control inputUser" id="endereco" name="endereco" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Cadastrar</button>
                </fieldset>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
