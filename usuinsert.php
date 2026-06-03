<?php
include('connect.php');

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $reduzido = $_POST['reduzido'];
    $master = $_POST['master'];

    $sql = 'insert into al_usuario (nome, email, senha, reduzido, master)
            values ("' . $nome . '", "' . $email . '", "' . $senha . '", "' . $reduzido . '", "' . $master . '")';

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: ususelect.php');
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select.css">
    <link rel="icon" type="image/png" href="assets/img/flaticon.png">
    <title>Incluir Usuário</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form action="" method="post">

                <div class="form-group">
                    <label>Nome:</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="nome"
                        placeholder="Nome do Usuário"
                        required>
                </div>

                <div class="form-group">
                    <label>Nome reduzido:</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="reduzido"
                        placeholder="Apenas o primeiro nome"
                        required>
                </div>

                <div class="form-group">
                    <label>Email:</label>

                    <input
                        type="email"
                        class="form-control custom-input"
                        name="email"
                        placeholder="Email"
                        required>
                </div>

                <div class="form-group">
                    <label>Senha:</label>

                    <input
                        type="password"
                        class="form-control custom-input"
                        name="senha"
                        placeholder="Senha"
                        required>
                </div>

                <div class="form-group">

                    <label for="master">Administrador:</label>

                    <select
                        name="master"
                        id="master"
                        class="form-control custom-input custom-select"
                        required>

                        <option value="0">Não</option>
                        <option value="1">Sim</option>

                    </select>

                </div>
                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Adicionar
                    </button>

                    <a href="ususelect.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>