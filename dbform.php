<?PHP
include("dealWithALLtheShit.php");

$displayForm = false;
if(isset($_POST["submit"])){

	$id = (isset($_POST['id']) ? $_POST['id'] : "");
	$email = (isset($_POST['email']) ? $_POST['email'] : "");

	$sender = array();
	$sender["name"] = (isset($_POST['nameS']) ? $_POST['nameS'] : "");
	$sender["address_line1"] = (isset($_POST['address_line1S']) ? $_POST['address_line1S'] : "");
	$sender["address_line2"] = (isset($_POST['address_line2S']) ? $_POST['address_line2S'] : "");
	$sender["address_city"] = (isset($_POST['address_cityS']) ? $_POST['address_cityS'] : "");
	$sender["address_state"] = (isset($_POST['address_stateS']) ? $_POST['address_stateS'] : "");
	$sender["address_zip"] = (isset($_POST['address_zipS']) ? $_POST['address_zipS'] : "");




	if(!isset($id,$email,$sender["name"],$sender["address_line1"],$sender["address_city"],$sender["address_state"],$sender["address_zip"])) {
		$displayForm = true;
		echo "Not all data filled out";
	}else{

		echo "Trying to add address...<pre>";
		try{
			//Submit shit
			$doShite = new doShite();
			$doShite->saveAddress($sender,$email,$id);
		}catch (Exception $e){
			if($e->getMessage() == "Invalid Address"){
				echo "</pre><span class=\"errors\">Invalid Address, plese try again.</span>";
				$displayForm = true;
			}else{
				echo "</pre>Unknown error: <pre>";
				print_r($e);
				echo "</pre>";
			}
		}
		if(!$displayForm)
			echo "</pre>Data submitted successfully";
	}
}else{//Display form
	$displayForm = true;
}

if($displayForm):
?>
<form name="input" action="?Page=db" method="POST">
	<div>
		<fieldset>
			<legend>Sender</legend>
			<label for="id">
				ID: <input id="id" type="text" name="id" <?php echo (isset($id) ? "value=\"" . $id . "\" " : ""); ?> required="required">
			</label>
			<label for="email">
				Email: <input id="email" type="text" name="email" <?php echo (isset($email) ? "value=\"" . $email . "\" " : ""); ?> required="required">
			</label>
			<label for="nameS">
				Name: <input id="nameS" type="text" name="nameS" <?php echo (isset($sender["name"]) ? "value=\"" . $sender["name"] . "\" " : ""); ?> required="required">
			</label>
			<label for="address_line1S">
				Address Line 1: <input id="address_line1S" type="text" name="address_line1S" <?php echo (isset($sender["address_line1"]) ? "value=\"" . $sender["address_line1"] . "\" " : ""); ?> required="required">
			</label>
			<label for="address_line2S">
				Address Line 2: <input id="address_line2S" type="text" name="address_line2S" <?php echo (isset($sender["address_line2"]) ? "value=\"" . $sender["address_line2"] . "\" " : ""); ?> >
			</label>
			<label for="address_cityS">
				City: <input id="address_cityS" type="text" name="address_cityS" <?php echo (isset($sender["address_city"]) ? "value=\"" . $sender["address_city"] . "\" " : ""); ?> required="required">
			</label>
			<label for="address_stateS">
				State: <input id="address_stateS" type="text" name="address_stateS" <?php echo (isset($sender["address_state"]) ? "value=\"" . $sender["address_state"] . "\" " : ""); ?> pattern="[A-Za-z]{2}" required="required">
			</label>
			<label for="address_zipS">
				Zip: <input id="address_zipS" type="text" name="address_zipS" <?php echo (isset($sender["address_zip"]) ? "value=\"" . $sender["address_zip"] . "\" " : ""); ?> pattern="([0-9]{5}(-[0-9]{4})?)" required="required">
			</label>
		</fieldset>

		
	</div>


	<input name="submit" id="submit" type="submit" value="Submit">
</form>
<?php endif; ?>