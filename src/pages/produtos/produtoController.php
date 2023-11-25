<?php
require_once '../../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $conn = DbConnection::getInstance()->getConnection();
    $query = "SELECT * FROM produtos";
    $stmt = $conn->query($query);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    foreach ($produtos as $produto) {
      $html .= '<tr>';
      $html .= '<td class="editavel" data-id="' . $produto['id'] . '">' . $produto['id'] . '</td>';
      $html .= '<td class="editavel" data-nome>' . $produto['nome'] . '</td>';
      $html .= '<td class="editavel" data-descricao>' . $produto['descricao'] . '</td>';
      $html .= '<td class="editavel" data-preco>' . $produto['preco'] . '</td>';
      $html .= '<td class="editavel" data-quantidade>' . $produto['quantidade'] . '</td>';
      $html .= '<td><button class="btn btn-danger excluir-produto" data-id="' . $produto['id'] . '">Excluir</button></td>';
      $html .= '</tr>';
    }
    echo $html;
  } catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['acao'] === 'cadastrar') {
    try {
      $conn = DbConnection::getInstance()->getConnection();
      $nome = $_POST['nome'];
      $descricao = $_POST['descricao'];
      $preco = $_POST['preco'];
      $quantidade = $_POST['quantidade'];

      $query = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (:nome, :descricao, :preco, :quantidade)";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':descricao', $descricao);
      $stmt->bindParam(':preco', $preco);
      $stmt->bindParam(':quantidade', $quantidade);
      $stmt->execute();

      echo "Produto cadastrado com sucesso!";
    } catch (PDOException $e) {
      echo "Erro ao cadastrar o produto: " . $e->getMessage();
    }
  } elseif ($_POST['acao'] === 'atualizar') {
    try {
      $conn = DbConnection::getInstance()->getConnection();
      $produtos = $_POST['produtos'];

      foreach ($produtos as $id => $atributos) {
        $id = intval($atributos[0]);
        $nome = $atributos[1];
        $descricao = $atributos[2];
        $preco = $atributos[3];
        $quantidade = $atributos[4];

        $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
      }

      echo "Produtos atualizados com sucesso!";
    } catch (PDOException $e) {
      echo "Erro ao atualizar os produtos: " . $e->getMessage();
    }
  } elseif ($_POST['acao'] === 'excluir') {
    try {
      $conn = DbConnection::getInstance()->getConnection();
      $idExcluir = $_POST['excluir_id'];

      $query = "DELETE FROM produtos WHERE id = :id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $idExcluir);
      $stmt->execute();

      echo "Produto excluído com sucesso!";
    } catch (PDOException $e) {
      echo "Erro ao excluir o produto: " . $e->getMessage();
    }
  }
}
