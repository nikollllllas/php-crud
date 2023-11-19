<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Tela de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tela de Login</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();
                        if (isset($_SESSION['login_error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
                            unset($_SESSION['login_error']);
                        }
                        ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php require_once ("nomes.php"); ?>

</html>