<?PHP
/**
 * DB class
 * Weee.
 **/
class DB{
	var $DBH;
	function DB(){
		$db_host = 'webdb.uvm.edu';
		$db_user = 'mfurland_admin';
		$db_name = 'MFURLAND_GrandMail';
		$db_pass = '7Iyf5n2COxgJ4Ss8';
		$this->DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	}


	function addAddress($email,$id,$json){

		$SQL = "INSERT INTO addresses(owner,id,addressData) VALUES ('" . $email . "', '" . $id . "', '" . $json . "')";


		$sth = $this->DBH->prepare($SQL);
		$sth->execute();
		$err = $sth->errorInfo();
		if($err[0]!=="00000"){
			echo "FAILURE";
			die();
		}

	}

	function fetchHome($email){
		$SQL = "SELECT addressData FROM addresses WHERE id='home' AND owner = :owner";
		$statement = $this->DBH->prepare($SQL);
		$statement->execute(array(':owner' => $email));
		$row = $statement->fetch();

		if(empty($row)){
			throw new Exception("Who are you");
		}
		return $row[0];
	}

	function fetchRecipent($from,$to){
		$SQL = "SELECT addressData FROM addresses WHERE id=:id AND owner = :owner";
		$statement = $this->DBH->prepare($SQL);
		$statement->execute(array(':owner' => $from, ':id' => $to));
		$row = $statement->fetch();

		if(empty($row)){
			throw new Exception("Bad address ID");
		}

		return $row[0];
	}
}
