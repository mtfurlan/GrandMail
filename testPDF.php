<?PHP
error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("display_errors", 1);

$from = "Mark Furland <markfurland@gmail.com>";
$to = "f f@scuzztest.bymail.in";
$subject = "This is the subject";
$htmlContent = "<div class=\"gmail_default\" style=\"font-family:tahoma,sans-serif;display:inline\">Stuff<b>Bold</b><i>italic</i>Stuff</div>";



require_once("dompdf/dompdf_config.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html($htmlContent);
$dompdf->render();
file_put_contents("shiny.pdf", $dompdf->output( array("compress" => 0) ));
//$dompdf->stream("sample.pdf");


?>