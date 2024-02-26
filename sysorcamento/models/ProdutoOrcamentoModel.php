<?php
class ProdutoOrcamentoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function salvarProdutoOrcamento($orcamentoId, $nome, $valor) {
        $sql = "INSERT INTO produto_orcamento (orcamento_id, nome_produto, valor) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $orcamentoId, $nome, $valor);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar produto: " . $stmt->error);
        }

        return $stmt->insert_id;
    }

    public function obterProdutosPorOrcamento($orcamentoId) {
        $sql = "SELECT * FROM produto_orcamento WHERE orcamento_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orcamentoId);
        $stmt->execute();

        $result = $stmt->get_result();
        $produtos = $result->fetch_all(MYSQLI_ASSOC);

        return $produtos;
    }

    public function calcularSomaEListarProdutos($produtos) {
        if (empty($produtos)) {
            return array('produtos' => array(), 'total' => 0, 'listaProdutos' => '<p>Nenhum produto associado a este orçamento.</p>');
        }

        $listaProdutos = '<h2>Produtos do Orçamento</h2><ul>';
        foreach ($produtos as $produto) {
            $listaProdutos .= '<li>' . $produto['nome_produto'] . ' - R$ ' . number_format($produto['valor'], 2) . '</li>';
        }
        $listaProdutos .= '</ul>';

        $total = array_sum(array_column($produtos, 'valor'));

        $listaProdutos .= '<p>Total do Orçamento: R$ ' . number_format($total, 2) . '</p>';

        return array('produtos' => $produtos, 'total' => $total, 'listaProdutos' => $listaProdutos);
    }
}
?>
