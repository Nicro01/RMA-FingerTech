<?php
try {
    $con = new PDO(
        'sqlsrv:Server=; Database=',
        '',
        ''
    );
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    die();
}

?>
