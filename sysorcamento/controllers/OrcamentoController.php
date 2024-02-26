<?php
include_once 'models/OrcamentoModel.php';
include_once 'models/ProdutoOrcamentoModel.php';

class OrcamentoController {
    private $orcamentoModel;
    private $produtoOrcamentoModel;

    public function __construct($conn) {
        $this->orcamentoModel = new OrcamentoModel($conn);
        $this->produtoOrcamentoModel = new ProdutoOrcamentoModel($conn);
    }

    public function criarOrcamento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
            $nomeCliente = $_POST['nomeCliente'];
            $data = $_POST['data'];

            $orcamentoId = $this->orcamentoModel->salvarOrcamento($nomeCliente, $data);

            if ($orcamentoId) {
                if (isset($_POST['produtos']['nome']) && isset($_POST['produtos']['valor'])) {
                    $produtosNome = $_POST['produtos']['nome'];
                    $produtosValor = $_POST['produtos']['valor'];

                    foreach ($produtosNome as $index => $nomeProduto) {
                        $valorProduto = $produtosValor[$index];
                        $this->produtoOrcamentoModel->salvarProdutoOrcamento($orcamentoId, $nomeProduto, $valorProduto);
                    }
                }

                $_POST = array();

                header("Location: index.php?action=visualizarOrcamento&id=" . $orcamentoId);
                exit();
            }
        }

        include 'views/orcamento_view.php';
    }

    public function visualizarOrcamento($orcamentoId) {
        $orcamento = $this->orcamentoModel->obterOrcamentoPorId($orcamentoId);

        if ($orcamento) {
            $produtos = $this->produtoOrcamentoModel->obterProdutosPorOrcamento($orcamentoId);

            $resultado = $this->produtoOrcamentoModel->calcularSomaEListarProdutos($produtos);

            echo $resultado['listaProdutos'];
        } else {
            echo "Orçamento não encontrado.";
        }
    }
}

?>
