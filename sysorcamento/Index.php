
<?php

$conn = include __DIR__ . '/config/database.php';

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/models/' . $class_name . '.php';
});

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'criarOrcamento';
}

switch ($action) {
    case 'criarOrcamento':
        include 'controllers/OrcamentoController.php';
        $orcamentoController = new OrcamentoController($conn);
        $orcamentoController->criarOrcamento();
        break;
        case 'visualizarOrcamento':

            if (isset($_GET['id'])) {
                $orcamentoId = $_GET['id'];

                include 'controllers/OrcamentoController.php';
                $orcamentoController = new OrcamentoController($conn);
                $orcamentoController->visualizarOrcamento($orcamentoId);
            } else {
                echo "ID do orçamento não fornecido.";
            }
            break;
    default:
        echo "Ação desconhecida.";
}
