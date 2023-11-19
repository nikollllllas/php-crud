<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "usuario";
    $password = "senha";

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $username && $input_password === $password) {
        $_SESSION['logged_in'] = true;
        header("Location: menu.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Usuário ou senha inválidos.";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
