<?PHP
error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("display_errors", 1);
/**
 * This exists to deal withthis all the shit.
 * So mailform gets addresses in text, and a message, and needs to fix addresses and make objects.
 * inputEmail makes PDF and has emails that we need to extrapolate addresses from. ETC.
 **/
require 'vendor/autoload.php';
include 'db.php';


class doShite{
	var $lob;
	var $pdf;
	var $object;
	var $job;
	var $sender;
	var $recipient;
	var $subject;

	function doShite(){
		$apiKey = 'test_e843940124f6ac7068f839654ecf265c349';
		$this->lob = new \Lob\Lob($apiKey);

		$this->lob->setVersion('v1');
	}

	function addSubject($subject){
		$this->subject = $subject;
	}

	function addMessage($message){
		require_once("dompdf/dompdf_config.inc.php");

		$dompdf = new DOMPDF();
		$dompdf->load_html($message);
		$dompdf->render();
		$this->pdf = $dompdf->output( array("compress" => 0));

	}

	function addFormAddress(array $addressInfo){

		try {
			// Returns a valid address
			$adress = $this->lob->addresses()->create(array(
				'name'				=> $addressInfo["name"], // Required
				'address_line1'		=> $addressInfo["address_line1"], // Required
				'address_line2'		=> $addressInfo["address_line2"], // Optional
				'address_city'		=> $addressInfo["address_city"], // Required
				'address_state'		=> $addressInfo["address_state"], // Required
				'address_country'	=> 'US', // Required - Must be a 2 letter country short-name code (ISO 3316)
				'address_zip'		=> $addressInfo["address_zip"], // Required
			));
		} catch (\Lob\Exception\ValidationException $e) {
			die("Address failure");
		}
		if(isset($addressInfo["sender"]) && $addressInfo["sender"] === true){
			$this->sender = $adress;
		}else{
			$this->recipient = $adress;
		}
	}



	function makeObject(){
		// You can create an object by uploading a local file
		// by prepending a `@` to the local path
		try {
			// Returns a valid object

			file_put_contents("message.pdf", $this->pdf);

			$this->object = $this->lob->objects()->create(array(
				'name'			=> $this->subject, // Required
				'file'			=> '@'.realpath('message.pdf'), // Required
				'setting_id'	=> 100, //100 makes it a black and white document// Required
				'quantity'		=> 1, // Optional
			));

			unlink("message.pdf");//Delete file

		} catch (\Lob\Exception\ValidationException $e) {
			die("MakeObject Failure");// Do something
		}

	}



	function makeJob(){
		try {
			// Returns a valid job
			$this->job = $this->lob->jobs()->create(array(
				'name'			=> $this->subject,
				'to'			=> $this->recipient['id'], // Required
				'from'			=> $this->sender['id'], // Optional
				'object1'		=> $this->object['id'], // Required
				// Accepts N objects as long as you provide them
				// incrementally like object2, object3 and so on until it hits N...
				//'object2'		=> $object2['id'], // Optional
				//I am unsure what the following are, ignoring.
				//'packaging_id'	=> $packaging['id'], // Optional
				//'service_id'	=> $service['id'], // Optional
			));
		} catch (\Lob\Exception\ValidationException $e) {
			die("MakeJob failure.");// Do something
		}
	}


	function mailLetter(){//Exists for abstraction
		$this->makeObject();
		$this->makeJob();
	}




	function emailAddresses($fromStr, $toStr){
		$db = new DB();

		$fromArr = array();
		preg_match("/\<(.*)\>/",$fromStr,$fromArr);
		$from = $fromArr[1];
		$toArr = array();
		preg_match("/\<(.*)@scuzz/",$toStr,$toArr);
		$to = $toArr[1];

		$sender = json_decode($db->fetchHome($from),true);
		$sender["sender"]=true;
		$this->addFormAddress($sender);


		$recipient = json_decode($db->fetchRecipent($from,$to),true);
		$this->addFormAddress($recipient);

		//file_put_contents("out.txt","to: " . $to . "\nfrom: " . $from);

	}

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


	function saveAddress($address,$email,$id){
		$db = new DB();
		$json = json_encode($address);
		$db->addAddress($email,$id,$json);

	}










	function postcard(){
		die();//Not dealing with the name/message yet. Maybe in future.
		try {
			// Returns a valid postcard
			$postcard = $this->lob->postcards()->create(array(
				'name'		=> 'Demo Postcard job', // Required
				'to'		=> $receiverAddress['id'], // Required
				'from'		=> $senderAddress['id'], // Optional
				'message'	=> 'This an example message on back of the postcard'/*, // Optional
				// For both front and back parameters, you can also provide a public URL
				'front'		 => '@'.realpath('/users/m/f/mfurland/www-root/GrandMail/Shiney.pdf'), // Optional
				'back'		  => '@'.realpath('/path/to/your/file/goblue.pdf'), // Optional//*/
			));
		} catch (\Lob\Exception\ValidationException $e) {
			die();
		}
	}





}
