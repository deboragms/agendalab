<?php
include('connect.php');

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $reduzido = $_POST['reduzido'];
    $data = $_POST['data'];

    $sql = 'insert into al_feriado (nome, reduzido, data)
            values ("' . $nome . '", "' . $reduzido . '", "' . $data . '")';

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: ferselect.php');
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
    <title>Incluir Feriado</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form action="" method="post">

                <div class="form-group">
                    <label>Data:</label>

                    <input
                        type="date"
                        class="form-control custom-input"
                        name="data"
                        required>
                </div>

                <div class="form-group">
                    <label>Nome:</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="nome"
                        placeholder="Nome do Feriado"
                        required>
                </div>

                <div class="form-group">
                    <label>Nome reduzido:</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="reduzido"
                        placeholder="Nome do Feriado resumido"
                        required>
                </div>

                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Adicionar
                    </button>

                    <a href="ferselect.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>