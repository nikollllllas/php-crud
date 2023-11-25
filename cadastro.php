<?php
session_start();
require('./DbConnection.php');
require('PDO.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $instance = DbConnection::getInstance();
        $conn = $instance->getConnection();

        $username = $_POST['username'];
        $password = $_POST['password'];

    $sql = "INSERT INTO usuarios(usuario, senha), VALUES($username, $password)";
    $conn->insert($sql);
    header("location: telaCadastro.php");
}