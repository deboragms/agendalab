<?php 
if (!$_SESSION['email']) {
    header('location:index.php');
    exit();
}
?>