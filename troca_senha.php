<?php
session_start();
include('connect.php');
$id = $_SESSION['id'];

if (isset($_POST['submit'])) {

    $novasenha = $_POST['novasenha'];
    // if ($_POST['novasenha'] != $_POST['confirmarsenha']) {
    //     die('As senhas não coincidem.');
    // }
    $sql = 'update al_usuario
            set senha="' . $novasenha . '"
            where id=' . $id;

    $result = mysqli_query($con, $sql);

    if ($result) {

        session_destroy();

        header('location:index.php');
        exit();
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
    <title>Troca de Senha</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form action="" method="post">

                <div class="form-group">
                    <label>Nova senha:</label>

                    <input
                        type="password"
                        class="form-control custom-input"
                        name="novasenha"
                        required>

                </div>

                <div class="form-group">
                    <label>
                        <input
                            type="checkbox"
                            onclick="novasenha.type = this.checked ? 'text' : 'password'">

                        Visualizar senha
                </div>

                <div class="form-group">
                    <label>Confirmar senha:</label>

                    <input
                        type="password"
                        class="form-control custom-input"
                        name="confirmarsenha"
                        required>
                </div>

                <div class="form-group">
                    <label>
                        <input
                            type="checkbox"
                            onclick="confirmarsenha.type = this.checked ? 'text' : 'password'">

                        Visualizar senha
                </div>

                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Atualizar
                    </button>

                    <a href="index.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>