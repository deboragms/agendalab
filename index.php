<?php
session_start();
include('connect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/img/flaticon.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <img src="assets/img/logoindex.png" alt="Logo" class="logo">

            <?php if (isset($_SESSION['nao_autenticado'])): ?>

                <div class="alert">
                    Usuário ou senha inválidos.
                </div>

            <?php
                unset($_SESSION['nao_autenticado']);
            endif;
            ?>

            <form action="login.php" method="post">

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu email"
                        required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required>
                </div>

                <button type="submit">
                    Conectar
                </button>

            </form>

        </div>

    </div>

</body>

</html>