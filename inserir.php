<?php 
require_once ("menu.php");
require_once ("formInsert.html");

if (isset($_GET["mensagem"])) {
    $format_mensagem = '<div>Mensagem: %s</div>';
    printf($format_mensagem, $_GET["mensagem"]);
}
?>