<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Style.css">
    <title>Tela de Orçamentos</title>
</head>
<body>

    <h1>Criar Orçamento</h1>

    <form action="index.php" method="post">
        <label for="nomeCliente">Nome do Cliente:</label>
        <input type="text" id="nomeCliente" name="nomeCliente" required>

        <label for="data">Data da Solicitação:</label>
        <input type="date" id="data" name="data" required>

        <h2>Produtos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody id="produtosTableBody">
            </tbody>
        </table>

        <button type="button" onclick="adicionarProduto()">Adicionar Produto</button>
        <button type="submit">Concluir Orçamento</button>
    </form>

    <h2>Produtos Selecionados</h2>
    <table>
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['produtos']['nome']) && isset($_POST['produtos']['valor'])) {
                $produtosNome = $_POST['produtos']['nome'];
                $produtosValor = $_POST['produtos']['valor'];

                foreach ($produtosNome as $index => $nomeProduto) {
                    $valorProduto = $produtosValor[$index];
                    echo "<tr><td>$nomeProduto</td><td>$valorProduto</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_POST['produtos']['valor'])) {
        $total = array_sum($_POST['produtos']['valor']);
        echo "<p>Total até o momento: R$ " . number_format($total, 2, ',', '.') . "</p>";
    }
    ?>

    <script>
        function adicionarProduto() {
            var tableBody = document.getElementById("produtosTableBody");
            var newRow = tableBody.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);

            cell1.innerHTML = '<input type="text" name="produtos[nome][]" required>';
            cell2.innerHTML = '<input type="number" name="produtos[valor][]" step="0.01" required>';
        }
    </script>

</body>
</html>
