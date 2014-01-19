<?PHP
error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("display_errors", 1);
include("dealWithALLtheShit.php");

$from = isset($_POST["from"]) ? $_POST["from"] : "";
$to = isset($_POST["to"]) ? $_POST["to"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["html"]) ? $_POST["html"] : "";

		try{
			//Submit shit
			$doShite = new doShite();
			$doShite->emailAddresses($from, $to);
			$doShite->addMessage($message);
			$doShite->addSubject($subject);
			$doShite->mailLetter();//SENT MOTHERFUCKERS.
		}catch (Exception $e){
			echo "Death<pre>";
			
			$message = "Something went wrong: \n" . print_r($e,true);

			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70, "\r\n");

			// Send
			$fromArr = array();
			preg_match("/\<(.*)\>/",$from,$fromArr);
			mail($fromArr[1], 'GrandMail Message Failure', $message);
		}