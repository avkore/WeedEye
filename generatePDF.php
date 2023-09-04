<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;


$dompdf = new Dompdf();

$dompdf->setPaper("A4", "landscape");
$dompdf->loadHtml("HELLO BRO");

$dompdf->render();
$dompdf->stream("invoice.pdf");

