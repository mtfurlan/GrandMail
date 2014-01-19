<?PHP

error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("display_errors", 1);


if(isset($_POST["submit"])){


	require 'vendor/autoload.php';

	$apiKey = 'test_e843940124f6ac7068f839654ecf265c349';
	$lob = new \Lob\Lob($apiKey);

	$lob->setVersion('v1'); 

	/*
	// Returns a valid address with more details
	$address = $lob->addresses()->verify(array(
		'address_line1'		=> (isset($_POST['address_line1']) ? $_POST['address_line1'] : ""), // Optional
		'address_line2'		=> (isset($_POST['address_line2']) ? $_POST['address_line2'] : ""), // Optional
		'address_city'		=> (isset($_POST['address_city'])  ? $_POST['address_city']  : ""), // Optional
		'address_state'		=> (isset($_POST['address_state']) ? $_POST['address_state'] : ""), // Optional
		'address_country'	=> "US",  // Optional
		'address_zip'		=> (isset($_POST['address_zip'])   ? $_POST['address_zip']   : ""), // Optional
	));*/

  // Returns a valid address with more details
  $address = $lob->addresses()->verify(array(
      'address_line1'     => '123 Test Street', // Optional
      'address_line2'     => 'Unit 199', // Optional
      'address_city'      => 'Mountain View', // Optional
      'address_state'     => 'CA', // Optional
      'address_country'   => 'US',  // Optional
      'address_zip'       => '94085', // Optional
  ));

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

	<textarea id="message" placeholder="Enter your message here..." required="textarea"></textarea>


	<input name="submit" id="submit" type="submit" value="Submit">
</form>
FORM;
}