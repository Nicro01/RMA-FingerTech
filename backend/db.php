<?php
try {
    $con = new PDO(
        'sqlsrv:Server=189.113.148.200, 5398; Database=Finger_Net',
        'Finger_Tech',
        '8r/%Vy1kGOW.~kV'
    );
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    die();
}

?>