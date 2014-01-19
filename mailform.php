<?PHP
include("dealWithALLtheShit.php");

$displayForm = false;
if(isset($_POST["submit"])){

	$sender = array();
	$sender["name"] = (isset($_POST['nameS']) ? $_POST['nameS'] : "");
	$sender["address_line1"] = (isset($_POST['address_line1S']) ? $_POST['address_line1S'] : "");
	$sender["address_line2"] = (isset($_POST['address_line2S']) ? $_POST['address_line2S'] : "");
	$sender["address_city"] = (isset($_POST['address_cityS']) ? $_POST['address_cityS'] : "");
	$sender["address_state"] = (isset($_POST['address_stateS']) ? $_POST['address_stateS'] : "");
	$sender["address_zip"] = (isset($_POST['address_zipS']) ? $_POST['address_zipS'] : "");
	$sender["sender"] = true;

	$recipient = array();
	$recipient["name"] = (isset($_POST['nameR']) ? $_POST['nameR'] : "");
	$recipient["address_line1"] = (isset($_POST['address_line1R']) ? $_POST['address_line1R'] : "");
	$recipient["address_line2"] = (isset($_POST['address_line2R']) ? $_POST['address_line2R'] : "");
	$recipient["address_city"] = (isset($_POST['address_cityR']) ? $_POST['address_cityR'] : "");
	$recipient["address_state"] = (isset($_POST['address_stateR']) ? $_POST['address_stateR'] : "");
	$recipient["address_zip"] = (isset($_POST['address_zipR']) ? $_POST['address_zipR'] : "");
	$recipient["sender"] = false;

	$subject = (isset($_POST['subject']) ? $_POST['subject'] : "");
	$message = (isset($_POST['message']) ? $_POST['message'] : "");


	if(!isset($nameS,$address_line1S,$address_cityS,$address_stateS,$address_zipS,$nameR,$address_line1R,$address_cityS,$address_stateR,$address_zipR,$subject,$message)) {
		$displayForm = true;
	}

	echo "Trying to send letter...<pre>";
	try{
		//Submit shit
		$doShite = new doShite();
		$doShite->addMessage($message);
		$doShite->addSubject($subject);
		$doShite->addFormAddress($sender);
		$doShite->addFormAddress($recipient);
		$doShite->mailLetter();//SENT MOTHERFUCKERS.
	}catch (Exception $e){
		echo "</pre>Letter could not be sent: <pre>";
		print_r($e);
		echo "</pre>";
	}

	echo "</pre>Letter sent successfully";

}else{//Display form
	$displayForm = true;
}

if($displayForm){
	echo <<<FORM
<form name="input" action="?Page=form" method="POST">
	<div>
		<fieldset>
			<legend>Sender</legend>
			<label for="nameS">
				Name: <input id="nameS" type="text" name="nameS" required="required">
			</label>
			<label for="address_line1S">
				Address Line 1: <input id="address_line1S" type="text" name="address_line1S" required="required">
			</label>
			<label for="address_line2S">
				Address Line 2: <input id="address_line2S" type="text" name="address_line2S">
			</label>
			<label for="address_cityS">
				City: <input id="address_cityS" type="text" name="address_cityS" required="required">
			</label>
			<label for="address_stateS">
				State: <input id="address_stateS" type="text" name="address_stateS" pattern="[A-Z]{2}" required="required">
			</label>
			<label for="address_zipS">
				Zip: <input id="address_zipS" type="text" name="address_zipS" pattern="([0-9]{5}(-[0-9]{4})?)" required="required">
			</label>
		</fieldset>

		<fieldset>
			<legend>Recipient</legend>
			<label for="nameR">
				Name: <input id="nameR" type="text" name="nameR" required="required">
			</label>
			<label for="address_line1R">
				Address Line 1: <input id="address_line1R" type="text" name="address_line1R" required="required">
			</label>
			<label for="address_line2R">
				Address Line 2: <input id="address_line2R" type="text" name="address_line2R">
			</label>
			<label for="address_cityR">
				City: <input id="address_cityR" type="text" name="address_cityR" required="required">
			</label>
			<label for="address_stateR">
				State: <input id="address_stateR" type="text" name="address_stateR" pattern="[A-Z]{2}" required="required">
			</label>
			<label for="address_zipR">
				Zip: <input id="address_zipR" type="text" name="address_zipR" pattern="([0-9]{5}(-[0-9]{4})?)" required="required">
			</label>
		</fieldset>
	</div>
	<label for="subject">
		Subject: <input id="subject" type="text" name="subject" required="required">
	</label>
	<textarea id="message" name="message" placeholder="Enter your message here..." required="textarea"></textarea>


	<input name="submit" id="submit" type="submit" value="Submit">
</form>
FORM;
}