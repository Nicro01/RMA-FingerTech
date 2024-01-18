<?php
include 'db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    var_dump($data);

    if (isset($data)) {
        $date = new DateTime($data[0]['Data']);
        $formattedDate = $date->format('Y-m-d\TH:i:s.000\Z');
        $nome = $data[0]['Nome'];
        $cnpj = $data[0]['CNPJ'];
        $email = $data[0]['Email'];
        $telefone = $data[0]['Telefone'];
        $estado = $data[0]['Estado'];
        $status = $data[0]['Status'];
        $datastatus = new DateTime();
        $formattedDateStatus = $datastatus->format('Y-m-d\TH:i:s.000\Z');
        $observacao = $data[0]['Observacao'];
        $responsavel = $data[0]['Responsavel'];
        $garantia = $data[0]['Garantia'];

        $stmt = $con->prepare("INSERT INTO TabRma (Data, Nome, CNPJ, Email, Telefone, Estado, Status, DataStatus, Observacao ,Responsavel, Garantia) VALUES (:Data, :Nome, :CNPJ, :Email, :Telefone, :Estado, :Status, :DataStatus, :Observacao ,:Responsavel, :Garantia)");
        $stmt->bindValue(':Data', $formattedDateStatus, PDO::PARAM_STR);
        $stmt->bindValue(':Nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':CNPJ', $cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':Email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':Telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':Status', $status, PDO::PARAM_NULL);
        $stmt->bindValue(':DataStatus', $formattedDateStatus, PDO::PARAM_NULL);
        $stmt->bindValue(':Observacao', 'teste', PDO::PARAM_NULL);
        $stmt->bindValue(':Responsavel', $responsavel, PDO::PARAM_STR);
        $stmt->bindValue(':Garantia', $garantia, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $rma = $con->lastInsertId();

            foreach ($data as $product) {
                $stmt = $con->prepare("INSERT INTO TabItemrma (RMA, Produto, Serial, Modelo, Data, NotaFiscal, Defeito) VALUES (:RMA, :Produto, :Serial, :Modelo, :Data, :NotaFiscal, :Defeito)");
                $stmt->bindValue(':RMA', $rma, PDO::PARAM_STR);
                $stmt->bindValue(':Produto', $product['Produto'], PDO::PARAM_STR);
                $stmt->bindValue(':Serial', $product['Serial'], PDO::PARAM_STR);
                $stmt->bindValue(':Modelo', $product['Modelo'], PDO::PARAM_STR);
                $stmt->bindValue(':Data', $formattedDate, PDO::PARAM_STR);
                $stmt->bindValue(':NotaFiscal', $product['NotaFiscal'], PDO::PARAM_STR);
                $stmt->bindValue(':Defeito', $product['Observacao'], PDO::PARAM_STR);

                if (!$stmt->execute()) {
                    echo json_encode(['success' => false]);
                    return;
                }
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->errorInfo()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing field']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>