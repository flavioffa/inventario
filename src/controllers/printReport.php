<?php
session_start();
requireValidSession(true);

// reference the Dompdf namespace
use Dompdf\Dompdf;

// include autoloader
require_once 'dompdf/autoload.inc.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$tableReport = $_POST['tableContent'];

$dompdf->loadHtml($tableReport);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(
    'Relatório_inventário.pdf',
    [
        'Attachment' => false // Para realizar o dowload mudar par true
    ]
);
// var_dump($_POST['tableContent']);