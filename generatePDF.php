<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

// $name = $_POST["name"];
// $quantity = $_POST["quantity"];

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "portrait");


$html = file_get_contents("template.html");

// $html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $quantity], $html);

$dompdf->loadHtml($html);
$dompdf->render();

$dompdf->stream("invoice.pdf", ["Attachment" => 0]);
exit;
