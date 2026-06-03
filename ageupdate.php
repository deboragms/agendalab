<?php
session_start();

include('connect.php');

/* Recebe o ID vindo do modal
*/

$id = $_GET['updateid'] ?? '';

if ($id == '') {

    header('location: ageselect.php');

    exit;
}

/*
Busca o agendamento atual
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
Caso não encontre
*/

if (!$campo) {

    die('Agendamento não encontrado.');
}

/*
Carrega dados atuais
*/

$nome = $campo['usuario'];

$data = $campo['data'];

$turno = $campo['turno'];

$obs = $campo['obs'];

$idempresa = $campo['idempresa'];

$idambiente = $campo['idambiente'];

/*
UPDATE
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

    $data = $_POST['data'];

    $turno = $_POST['turno'];

    $obs = $_POST['obs'];

    $idempresa = $_POST['idempresa'];

    $idambiente = $_POST['idambiente'];

    /*
    Atualiza o registro corretamente
    */

    $sqlupdate = 'update al_agenda set

                    data="' . $data . '",
                    turno="' . $turno . '",
                    obs="' . $obs . '",
                    idempresa="' . $idempresa . '",
                    idambiente="' . $idambiente . '"

                  where id="' . $id . '"';

    $resultupdate = mysqli_query($con, $sqlupdate);

    if ($resultupdate) {

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

    <link rel="icon" type="image/png" href="assets/img/flaticon.png">

    <title>Alterar Agendamento</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form method="post">

                <!--
                Mantém o ID oculto
                -->

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $id; ?>">

                <div class="form-group">

                    <label>Nome</label>

                    <!--
                    Usuário apenas visualização
                    -->

                    <input
                        type="text"
                        class="form-control custom-input"
                        value="<?php echo $nome; ?>"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Ambiente</label>

                    <select
                        name="idambiente"
                        class="form-control custom-input custom-select"
                        required>

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
                        name="obs"
                        value="<?php echo $obs; ?>"
                        required>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        name="submit"
                        class="custom-btn">

                        Alterar

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
```