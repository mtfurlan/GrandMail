<?PHP
error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("error_log", "err.log");
include("dealWithALLtheShit.php");

$from = isset($_POST["from"]) ? $_POST["from"] : "";
$to = isset($_POST["to"]) ? $_POST["to"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["html"]) ? $_POST["html"] : "";
/*
    [subject] => Subject
    [to] => f <f@scuzztest.bymail.in>
    [html] => <div dir="ltr"><div class="gmail_default" style="font-family:tahoma,sans-serif">Oh look a message<br clear="all"></div><br>-- <br>Mark Furland<br>^M
</div>

    [from] => Mark Furland <markfurland@gmail.com>
    [text] => Oh look a message^M
^M
-- ^M
Mark Furland
*/
/*
$to = "f <debolt@scuzztest.bymail.in>";
$from = "Mark Furland <markfurland@gmail.com>";
$subject = "subect";
$message = "Message of science";
*/

$fromArr = array();
preg_match("/\<(.*)\>/",$from,$fromArr);
$fromEmail = $fromArr[1];

		try{
			//Submit shit
			$doShite = new doShite();
			$addresses = $doShite->emailAddresses($from, $to);
			$doShite->addMessage($message);
			$doShite->addSubject($subject);
			$doShite->mailLetter();//SENT MOTHERFUCKERS.

			
			$message = "Success, message sent to \n" . $addresses[1]["name"] . "\n" . $addresses[1]["address_line1"] . "\n" . (isset($addresses[1]["address_line2"]) ? $addresses[1]["address_line2"] . "\n" : "") . $addresses[1]["address_city"] . ", " . $addresses[1]["address_state"] . " " . $addresses[1]["address_zip"] . "\n\nWith a message of \n" . $message;


			$message = wordwrap($message, 70, "\r\n");
			mail($fromEmail, 'GrandMail Message Success', $message);

		}catch (Exception $e){
			switch($e->getMessage()){
				case "Bad address ID":
					$message = "Bad target ID, please try again";
					break;
				case "Who are you":
					$message = "Who are you?\nI'm sorry, but you aren't in our records. Possibly recheck what email you are sending from?";
					break;
				default:
					$message = "Something went wrong: \n" . print_r($e,true);

			}
			
			
			$message = wordwrap($message, 70, "\r\n");
			mail($fromEmail, 'GrandMail Message Failure', $message);
		}