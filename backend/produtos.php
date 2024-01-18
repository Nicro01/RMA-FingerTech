<?php
include 'db.php';

// Check if the connection was successful
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT proDescricao FROM TabJNProdutos WHERE status LIKE '%" . 1 . "%'";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if ($stmt->execute()) {
        $data = [];
        $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetchedData as $row) {
            $data[] = ['name' => $row['proDescricao']];
        }
    }
    echo json_encode($data, JSON_PRETTY_PRINT);
}


?>