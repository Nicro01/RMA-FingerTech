<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    // FTP server details

    $ftp_host = "ftp.fingertech.com.br";
    $ftp_username = 'fingertech';
    $ftp_password = 'fgtc2014ic';

    // Establish an FTP connection
    $ftp_conn = ftp_connect($ftp_host) or die("Could not connect to $ftp_host");
    $login = ftp_login($ftp_conn, $ftp_username, $ftp_password);

    if ($login) {
        // Check if 'tmp_name' is an array
        echo json_encode($_FILES);
        if (is_array($_FILES['files']['tmp_name'])) {
            // Loop through each file and upload it to the FTP server



            foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                $local_file = $tmpName;
                $remote_file = 'www/rma/nf/' . $_FILES['files']['name'][$key];

                if (ftp_put($ftp_conn, $remote_file, $local_file, FTP_BINARY)) {
                    echo "Successfully uploaded " . $_FILES['files']['name'][$key] . "\n";
                } else {
                    echo "There was a problem uploading " . $_FILES['files']['name'][$key] . "\n";
                }
            }
        } else {
            echo "No files were uploaded or form enctype was not set to multipart/form-data.\n";
        }
    } else {
        echo "Could not log in to FTP server with username $ftp_username";
    }

    // Close the FTP connection
    ftp_close($ftp_conn);
}