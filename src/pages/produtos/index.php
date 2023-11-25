<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Listagem de Produtos</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Lista de Produtos</h1>
      <div>
        <a href="cadastro.php" class="btn btn-primary mr-2">Cadastrar Novo Produto</a>
        <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
    <div class="table-responsive">
      <button id="salvarAlteracoes" class="btn btn-success mb-3">Salvar Alterações</button>
      <table class="table table-striped" id="tabelaProdutos">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome do Produto</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(() => {
      let produtosAtualizados = {};

      function carregarProdutos() {
        $.ajax({
          url: 'produtoController.php',
          method: 'GET',
          success: (response) => {
            $('#tabelaProdutos tbody').html(response);
          },
          error: () => {
            alert('Erro ao carregar os produtos.');
          }
        });
      }

      carregarProdutos();

      $('#tabelaProdutos').on('dblclick', 'td.editavel', function() {
        $(this).addClass('celula-em-edicao');
        $(this).attr('contenteditable', 'true');
      });

      $('#salvarAlteracoes').on('click', () => {
        $('#tabelaProdutos tbody tr').each(function() {
          const id = $(this).find('td:eq(0)').text();
          const nome = $(this).find('td:eq(1)').text();
          const descricao = $(this).find('td:eq(2)').text();
          const preco = $(this).find('td:eq(3)').text();
          const quantidade = $(this).find('td:eq(4)').text();

          produtosAtualizados[id] = [id, nome, descricao, preco, quantidade];
        });

        salvarAlteracoes();
      });

      function salvarAlteracoes() {
        $.ajax({
          url: 'produtoController.php',
          method: 'POST',
          data: {
            acao: 'atualizar',
            produtos: produtosAtualizados
          },
          success: (response) => {
            alert(response);
            carregarProdutos();
            produtosAtualizados = {};
          },
          error: () => {
            alert('Erro ao atualizar os produtos.');
          }
        });
      }

      //excluir produto
      $('#tabelaProdutos').on('click', 'button.excluir-produto', () => {
        const idExcluir = $(this).data('id');
        if (confirm('Tem certeza que deseja excluir este produto?')) {
          $.ajax({
            url: 'produtoController.php',
            method: 'POST',
            data: {
              acao: 'excluir',
              excluir_id: idExcluir
            },
            success: (response) => {
              alert(response);
              carregarProdutos();
            },
            error: () => {
              alert('Erro ao excluir o produto.');
            }
          });
        }
      });
    });
  </script>
</body>

</html>
