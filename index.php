<?php
require 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$html = file_get_contents(__DIR__ .  "/certificat_de_realisation.html");
$html = str_replace("{folder}", "https://ns305834.ip-37-187-23.eu/bvf/dompdfBVF", $html);

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);

$context = stream_context_create([ 
	'ssl' => [ 
		'verify_peer' => FALSE, 
		'verify_peer_name' => FALSE,
		'allow_self_signed'=> TRUE 
	] 
]);
$dompdf->setHttpContext($context);

$dompdf->loadHtml($html);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();