<?php
session_start();
include('connect.php');

$nome = $_GET['nome'] ?? $_SESSION['nome'] ?? '';
$turno = $_GET['turno'] ?? '';
$data = $_GET['data'] ?? '';

$sqlempresa = 'select * from al_empresa order by nome';
$resultempresa = mysqli_query($con, $sqlempresa);

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $turno = $_POST['turno'];
    $obs = $_POST['obs'];
    $idempresa = $_POST['idempresa'];
    $idambiente = $_POST['idambiente'];

    /*
    Busca o ID do usuário pelo nome
    */

    $sqlusuario = 'select id from al_usuario
                   where nome="' . $nome . '"';

    $resultusuario = mysqli_query($con, $sqlusuario);
    $campousuario = mysqli_fetch_assoc($resultusuario);
    $idusuario = $campousuario['id'];

    /*
    Insert completo conforme SQL
    */

    $sql = 'insert into al_agenda
            (
                data,
                turno,
                obs,
                idusuario,
                idambiente,
                idempresa
            )
            values
            (
                "' . $data . '",
                "' . $turno . '",
                "' . $obs . '",
                "' . $idusuario . '",
                "' . $idambiente . '",
                "' . $idempresa . '"
            )';

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: ageselect.php');
        exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select.css">
    <title>Incluir Agendamento</title>

</head>

<body>

    <div class="page-container">
        <div class="content-box">
            <form method="post">
                <div class="form-group">

                    <label>Nome</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="nome"
                        value="<?php echo $nome; ?>"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Ambiente</label>

                    <input
                    type="text"
                        name="idambiente"
                        class="form-control custom-input"
                        value = "<?php echo $amb['nome']; ?>"
                        readonly>



                        <option value=""></option>

                        <?php

                        $sqlamb = 'select * from al_ambiente order by nome';

                        $resultamb = mysqli_query($con, $sqlamb);

                        while ($amb = mysqli_fetch_assoc($resultamb)) {

                            echo '<option value="' . $amb['id'] . '" ? selected : >';
                            echo $amb['nome'];
                            echo '</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Data</label>

                    <input
                        type="date"
                        class="form-control custom-input"
                        name="data"
                        value="<?php echo $data; ?>"
                        required>

                </div>

                <div class="form-group">

                    <label>Turno</label>

                    <select
                        name="turno"
                        class="form-control custom-input custom-select"
                        required>

                        <option value="M" <?= $turno == 'M' ? 'selected' : '' ?>>
                            Matutino
                        </option>

                        <option value="V" <?= $turno == 'V' ? 'selected' : '' ?>>
                            Vespertino
                        </option>

                        <option value="N" <?= $turno == 'N' ? 'selected' : '' ?>>
                            Noturno
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Empresa</label>

                    <select
                        name="idempresa"
                        class="form-control custom-input custom-select"
                        required>

                        <option value="">Selecione</option>

                        <?php

                        while ($empresa = mysqli_fetch_assoc($resultempresa)) {

                            echo '<option value="' . $empresa['id'] . '">';
                            echo $empresa['nome'];
                            echo '</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Observação</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        name="obs"
                        required>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        name="submit"
                        class="custom-btn">
                        Agendar
                    </button>

                    <a href="ageselect.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>