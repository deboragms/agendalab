<?php
session_start();
include('connect.php');

if (empty($_POST['email']) || empty($_POST['senha'])) {
    $_SESSION['vazios'] = true;
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($con, $_POST['email']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);

$query = 'select id, nome, email, master from al_usuario where email="' . $email . '" and senha="' . $senha . '"';
$result = mysqli_query($con, $query);
$linha = mysqli_num_rows($result);

if ($linha == 1) {

    $usuario = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['master'] = $usuario['master'];

    if ($usuario['master'] == 1) {
        header('Location: menu.php');
    } else {
        header('Location: ageselect.php');
    }
    exit();

} else {
    $_SESSION['nao_autenticado'] = true;

    header('Location: index.php');

    exit();
}