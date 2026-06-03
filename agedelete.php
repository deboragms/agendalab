<?php
session_start();

include('connect.php');

/*
Recebe o ID corretamente vindo do modal
*/

$id = $_GET['deleteid'] ?? '';

if ($id == '') {

    header('location: ageselect.php');

    exit;
}

/*
Busca o agendamento
*/

$sql = 'select
            a.*,
            u.nome usuario
        from al_agenda a
        inner join al_usuario u on u.id = a.idusuario
        where a.id="' . $id . '"';

$result = mysqli_query($con, $sql);

$campo = mysqli_fetch_assoc($result);

/*
Se não encontrar
*/

if (!$campo) {

    die('Agendamento não encontrado.');
}

$nome = $campo['usuario'];

$data = $campo['data'];

$turno = $campo['turno'];

$obs = $campo['obs'];

$idempresa = $campo['idempresa'];

$idambiente = $campo['idambiente'];

/*
Excluir
*/

$admin = $_SESSION['master'] ?? 0;

if (
    $admin != 1
    &&
    $campo['usuario'] != $_SESSION['nome']
) {

    die('Acesso negado.');
}

if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    $sqldelete = 'delete from al_agenda
                  where id="' . $id . '"';

    $resultdelete = mysqli_query($con, $sqldelete);

    if ($resultdelete) {

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

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/select.css">

    <title>Excluir Agendamento</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form method="post">

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $id; ?>">

                <div class="form-group">

                    <label>Nome</label>

                    <input
                        type="text"
                        class="form-control custom-input"
                        value="<?php echo $nome; ?>"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Ambiente</label>

                    <select
                        class="form-control custom-input custom-select"
                        disabled>

                        <?php

                        $sqlamb = 'select * from al_ambiente order by nome';

                        $resultamb = mysqli_query($con, $sqlamb);

                        while ($amb = mysqli_fetch_assoc($resultamb)) {

                            $selected =
                                ($idambiente == $amb['id'])
                                ?
                                'selected'
                                :
                                '';

                            echo '<option value="' . $amb['id'] . '" ' . $selected . '>';
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
                        value="<?php echo $data; ?>"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Turno</label>

                    <select
                        class="form-control custom-input custom-select"
                        disabled>

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
                        class="form-control custom-input custom-select"
                        disabled>

                        <?php

                        $sqlempresa = 'select * from al_empresa order by nome';

                        $resultempresa = mysqli_query($con, $sqlempresa);

                        while ($empresa = mysqli_fetch_assoc($resultempresa)) {

                            $selected =
                                ($idempresa == $empresa['id'])
                                ?
                                'selected'
                                :
                                '';

                            echo '<option value="' . $empresa['id'] . '" ' . $selected . '>';
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
                        value="<?php echo $obs; ?>"
                        readonly>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        name="submit"
                        class="custom-btn">
                        Excluir
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