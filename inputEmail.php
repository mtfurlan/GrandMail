<?PHP

$from = $_POST["from"];
$to = $_POST["to"];
$subject = $_POST["subject"];
$htmlContent = $_POST["html"];



require_once("dompdf/dompdf_config.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html($subject . $htmlContent);
$dompdf->render();
file_put_contents("message.pdf", $dompdf->output( array("compress" => 0) ));


//Create message



unlink("message.pdf");//Delete file