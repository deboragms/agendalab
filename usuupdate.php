<?php
include('connect.php');
$id = $_GET['updateid'];
$sql = 'select * from al_usuario where id=' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$email = $row['email'];
$senha = $row['senha'];
$reduzido = $row['reduzido'];
$turnopreferido = $row['turnopreferido'];
$admin = $row['master'];

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $reduzido = $_POST['reduzido'];

    $sql = 'update al_usuario
            set nome ="' . $nome . '"
            , email ="' . $email . '"
            , senha ="' . $senha . '"
            , reduzido = "' . $reduzido . '"
            , turnopreferido = "' . $turnopreferido . '"
            , master = "' . $admin . '"
            where id=' . $id;

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

    <title>Alterar Usuário</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form action="" method="post">

                <div class="form-group">

                    <label>Nome</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="nome"
                        value="<?php echo $nome; ?>"
                        required>

                </div>

                <div class="form-group">

                    <label>Reduzido</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="reduzido"
                        value="<?php echo $reduzido; ?>"
                        required>

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        class="form-control custom-input"
                        name="email"
                        value="<?php echo $email; ?>"
                        required>

                </div>

                <div class="form-group">

                    <label>Senha</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="senha"
                        value="<?php echo $senha; ?>"
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

                <div class="form-group">

                    <label for="">Turno Preferido:</label>

                    <select
                        name="turnopreferido"
                        class="form-control custom-input custom-select"
                        required>

                        <option value="M" <?= $turnopreferido == 'M' ? 'selected' : '' ?>>
                            Matutino
                        </option>

                        <option value="V" <?= $turnopreferido == 'V' ? 'selected' : '' ?>>
                            Vespertino
                        </option>

                        <option value="N" <?= $turnopreferido == 'N' ? 'selected' : '' ?>>
                            Noturno
                        </option>

                    </select>
                </div>

                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Alterar
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