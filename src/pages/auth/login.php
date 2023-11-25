<?php
session_start();

require_once '../../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $instance = DBConnection::getInstance()->getConnection();

  $stmt = $instance->prepare('SELECT id, username, password FROM usuarios WHERE username = :username');
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: ../produtos/index.php');
    exit();
  } else {
    $_SESSION['error'] = 'Usuário ou senha incorretos';
    header('Location: login.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['success'])) {
          echo '<div class="alert alert-success" role="alert">';
          echo $_SESSION['success'];
          echo '</div>';
          unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $_SESSION['error'];
          echo '</div>';
          unset($_SESSION['error']);
        }
        ?>
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="username">Nome de Usuário:</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <p class="mt-3">Ainda não tem uma conta? <a href="signin.php">Cadastre-se</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
