<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Cadastro de Produtos</h1>
      <div>
        <a href="index.php" class="btn btn-primary mr-2">Voltar</a>
        <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
    <form id="form-cadastro" action="produtos.php" method="POST">
      <div class="form-group">
        <label for="nome">Nome do Produto:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="preco">Preço:</label>
        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="quantidade">Quantidade:</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
      </div>
      <input type="hidden" name="acao" value="cadastrar">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
  <script>
    $(document).ready(function() {
      $('#form-cadastro').on('submit', function(e) {
        e.preventDefault();
        var dados = $(this).serialize();
        $.ajax({
          url: 'produtosController.php',
          method: 'POST',
          data: dados + '&acao=cadastrar',
          success: function(response) {
            alert(response);
          }
        }).then(function() {
          window.location.href = 'index.php';
        });
      });
    });
  </script>
</body>

</html>
