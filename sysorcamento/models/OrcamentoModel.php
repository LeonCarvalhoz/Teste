<?php

class OrcamentoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function salvarOrcamento($nomeCliente, $data) {
        $sql = "INSERT INTO orcamento (nome_cliente, data_solicitacao) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $nomeCliente, $data);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function obterOrcamentoPorId($orcamentoId) {
        $sql = "SELECT * FROM orcamento WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orcamentoId);
        $stmt->execute();

        $result = $stmt->get_result();
        $orcamento = $result->fetch_assoc();

        return $orcamento;
    }
}
