<?php
include('connect.php');
$id = $_GET['deleteid'];
$sql = 'select * from al_usuario where id=' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$email = $row['email'];

if (isset($_POST['submit'])) {

    $sql = 'delete from al_usuario where id=' . $id;
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
    <title>Excluir Usuário</title>

</head>

<body>

    <div class="page-container">
        <div class="content-box">
            <form action="" method="post">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control custom-input" name="nome" value="<?php echo $nome; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control custom-input" name="email" value="<?php echo $email; ?>" readonly>
                </div>

                <div class="button-group">

                    <button type="submit" name="submit" class="custom-btn">
                        Excluir
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