<?php 
require_once ("PDO.php");

$q = $_REQUEST["q"];

$pdo = new usePDO();
$pdo->createDB();
$pdo->createTable();

switch ($q) {
    case "readProduto":
    	$result = $pdo->select("SELECT * FROM produto");
		print(json_encode($result->fetchAll()));
        break;
    case "update":
    	$id = $_REQUEST["id"];
    	$nome = $_REQUEST["nome"];
    	$marca = $_REQUEST["marca"];
    	$validade = $_REQUEST["validade"];
    	$preco = $_REQUEST["preco"];
		$lote = $_REQUEST["lote"];
    	$result = $pdo->update("UPDATE produto SET nome='$nome', marca='$marca', validade='$validade', preco='$preco', lote='$lote' WHERE id='$id'");
        echo "Registro id $id atualizado com sucesso";
        break;
    case "insert":
		$nome = $_REQUEST["nome"];
    	$marca = $_REQUEST["marca"];
    	$validade = $_REQUEST["validade"];
    	$preco = $_REQUEST["preco"];
		$lote = $_REQUEST["lote"];
    	$message = $pdo->insert("INSERT INTO produto (nome, marca, validade, preco, lote, usuario, senha) 
    		VALUES ('$nome', $marca, '$validade', '$preco', '$lote', 'jose_vieira','".sha1(456789)."')");
    		//outros campos são ficticios somente para evitarmos de redesenhar o banco 

        if ($message != NULL) {
            //var_dump($message);
            header("location: inserir.php?mensagem=$message");
        }else{
            header("location: inserir.php?mensagem=Registro inserido com sucesso");
        }
        break;
    case "delete":
    	$id = $_REQUEST["id"];
    	$pdo->delete("DELETE FROM produto WHERE id='$id'");
    	echo "Registro deletado com sucesso";
    	break;

}

?>