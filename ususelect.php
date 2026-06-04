<?php
include('connect.php');

$sql = 'select * from al_usuario where id !=1';
$pesqnome = '';

if (isset($_POST['submit'])) {
    $pesqnome = $_POST['pesqnome'];
    $reduzido = $_POST['reduzido'];
    $sql = $sql . ' and nome like "%' . $pesqnome . '%" and reduzido = "' . $reduzido . '"';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select.css">
    <link rel="icon" type="image/png" href="assets\img\flaticon.png">

    <title>Usuários</title>
</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form action="" method="post">

                <div class="form-group">
                    <label for="pesqnome">Nome Parcial</label>

                    <input
                        type="text"
                        name="pesqnome"
                        id="pesqnome"
                        class="form-control custom-input"
                        value="<?php echo $pesqnome; ?>">
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="custom-btn">
                        Consultar
                    </button>

                    <a href="menu.php" class="custom-btn btn-link-custom">
                        Menu
                    </a>

                    <a href="usuinsert.php" class="custom-btn btn-link-custom">
                        Incluir
                    </a>
                </div>

            </form>

            <div class="table-responsive mt-4">

                <table class="table table-striped table-bordered">

                    <thead class="thead">
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Reduzido</th>
                            <th>Email</th>
                            <th>Operações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $result = mysqli_query($con, $sql);

                        if ($result) {

                            while ($row = mysqli_fetch_assoc($result)) {

                                echo '
                                <tr>
                                    <th scope="row">' . $row['id'] . '</th>

                                    <td>' . $row['nome'] . '</td>

                                    <td>' . $row['reduzido'] . '</td>

                                    <td>' . $row['email'] . '</td>

                                    <td class="operation-buttons">

                                        <a href="usuupdate.php?updateid=' . $row['id'] . '" 
                                           class="btn btn-success btn-sm">
                                           Alterar
                                        </a>

                                        <a href="usudelete.php?deleteid=' . $row['id'] . '" 
                                           class="btn btn-danger btn-sm">
                                           Excluir
                                        </a>

                                    </td>
                                </tr>';
                            }
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>