<?php
    $file = 'monkey.gif';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/x-javascript');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
?>


<?php header('Content-Type: application/x-javascript'); ?>

$scope.model = <?php

if(isset($model)){
    echo "JSON.parse('" . json_encode($model) . "')";
}else{
    echo "false";
}
?>