<?php
session_start();
require_once '../../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $instance = DBConnection::getInstance()->getConnection();
  $stmt = $instance->prepare('SELECT id FROM usuarios WHERE username = :username');
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($existingUser) {
    $_SESSION['error'] = 'Nome de usuário já utilizado.';
    header('Location: signin.php');
    exit();
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $instance->prepare('INSERT INTO usuarios (username, password) VALUES (:username, :password)');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
      $_SESSION['success'] = 'Cadastro realizado com sucesso! Faça login para continuar.';
      header('Location: login.php');
      exit();
    } else {
      $_SESSION['error'] = 'Erro ao cadastrar o usuário.';
      header('Location: signin.php');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>Cadastro</h2>
        <?php
        if (isset($_SESSION['error'])) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $_SESSION['error'];
          echo '</div>';
          unset($_SESSION['error']);
        }
        ?>
        <form action="signin.php" method="POST">
          <div class="form-group">
            <label for="username">Nome de Usuário:</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-success">Cadastrar</button>
          <p class="mt-3">Já tem uma conta? <a href="login.php">Faça login</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
