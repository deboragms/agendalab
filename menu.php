<?php
session_start();
include('connect.php');
include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="shortcut icon" href="assets/img/flaticon.png" type="image/x-icon">
    <title>Menu</title>
</head>

<body>
    <div class="container menu-container">
        <div class="jumbotron menu-box">
            <div class="row justify-content-center">

                <div class="col-6 col-lg-2 mb-4">
                    <a href="ageselect.php" class="menu-item">
                        <img src="assets/img/calendario.png" alt="Agendamentos" class="menu-img img-fluid">
                        <span class="menu-label">Agendamentos</span>
                    </a>
                </div>

                <div class="col-6 col-lg-2 mb-4">
                    <a href="ususelect.php" class="menu-item">
                        <img src="assets/img/usuario.png" alt="Usuários" class="menu-img img-fluid">
                        <span class="menu-label">Usuários</span>
                    </a>
                </div>

                <div class="col-6 col-lg-2 mb-4">
                    <a href="empselect.php" class="menu-item">
                        <img src="assets/img/empresa.png" alt="Empresas" class="menu-img img-fluid">
                        <span class="menu-label">Empresas</span>
                    </a>
                </div>

                <div class="col-6 col-lg-2 mb-4">
                    <a href="ambselect.php" class="menu-item">
                        <img src="assets/img/sala.png" alt="Ambientes" class="menu-img img-fluid">
                        <span class="menu-label">Ambientes</span>
                    </a>
                </div>
                <div class="col-6 col-lg-2 mb-4">
                    <a href="ferselect.php" class="menu-item">
                        <img src="assets/img/feriado.png" alt="Ambientes" class="menu-img img-fluid">
                        <span class="menu-label">Feriados</span>
                    </a>
                </div>
                <div class="col-12 text-center mt-3">
                    <form action="index.php" method="post">
                        <button type="submit">Voltar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>