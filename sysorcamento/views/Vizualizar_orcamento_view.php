<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento</title>
    <link rel="stylesheet" href="./css/Style.css">
</head>
<body>

    <h1>Detalhes do Orçamento</h1>

    <h2>Informações do Orçamento</h2>
    <p><strong>ID do Orçamento:</strong> <?php echo $orcamento['id']; ?></p>
    <p><strong>Nome do Cliente:</strong> <?php echo $orcamento['nomecliente']; ?></p>
    <p><strong>Data da Solicitação:</strong> <?php echo $orcamento['data']; ?></p>

    <h2>Produtos Associados</h2>
    <?php if (!empty($produtos)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto) : ?>
                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Nenhum produto associado a este orçamento.</p>
    <?php endif; ?>


</body>
</html>
