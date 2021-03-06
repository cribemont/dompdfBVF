<?php
require 'vendor/autoload.php';

/* // reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// Load et MAJ du HTML
$html = file_get_contents(__DIR__ .  "/certificat_de_realisation.html");
$html = str_replace("{folder}", "https://ns305834.ip-37-187-23.eu/bvf/dompdfBVF", $html);

// Création DomPDF
$options = new Options();
// Fix pour les images en remote ?
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);


// Context SSL ?
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
$dompdf->stream(); */
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('version_dyn.docx');

// Texte
$templateProcessor->setValues(array('{nom_stagiaire}' => 'John', '{nom_formateur}' => 'Doe'));
// Images
$templateProcessor->setImageValue('{logo_bvf}', 'logo.png');

// Save et Export
$templateProcessor->saveAs('tmp/tmp_file.docx');

$temp = \PhpOffice\PhpWord\IOFactory::load('tmp/tmp_file.docx');

Gears\Pdf::convert('tmp/tmp_file.docx', 'tmp/gears.pdf');