<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmacionValue = $_POST['confirmacion'];

    if ($confirmacionValue === 'si') {
        header('Location: confirmar_si.php');
        exit();
    } elseif ($confirmacionValue === 'no') {
        header('Location: confirmar_no.html');
        exit();
    }
}
?>
