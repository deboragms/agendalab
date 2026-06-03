<?php
include('connect.php');
$id = $_GET['updateid'];
$sql = 'select * from al_ambiente where id=' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];


if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];

    $sql = 'update al_ambiente
            set nome ="' . $nome . '"
            where id=' . $id;

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location: ambselect.php');
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
    <link rel="icon" type="image/png" href="assets/img/flaticon.png">
    <title>Alterar Empresa</title>

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

                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Alterar
                    </button>

                    <a href="ambselect.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>