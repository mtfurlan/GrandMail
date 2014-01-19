<?php
	
	require 'vendor/autoload.php';

	error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
	ini_set("display_errors", 1);


	$apiKey = 'test_e843940124f6ac7068f839654ecf265c349';
	$lob = new \Lob\Lob($apiKey);

	$lob->setVersion('v1'); 

	echo get_class($lob->addresses());
	// >>> Lob\Resource\Addresses

	// Jobs
	echo get_class($lob->jobs());
	// >>> Lob\Resource\Jobs

	// Objects
	echo get_class($lob->objects());
	// >>> Lob\Resource\Objects
	try {
	    // Returns a valid address
	    $senderAddress = $lob->addresses()->create(array(
	        'name'              => 'Harry Zhang', // Required
	        'address_line1'     => '123 Test Street', // Required
	        'address_line2'     => 'Unit 199', // Optional
	        'address_city'      => 'Mountain View', // Required
	        'address_state'     => 'CA', // Required
	        'address_country'   => 'US', // Required - Must be a 2 letter country short-name code (ISO 3316)
	        'address_zip'       => '94085', // Required
	        'email'             => 'harry@lob.com', // Optional
	        'phone'             => '5555555555', // Optional
	    ));
	} catch (\Lob\Exception\ValidationException $e) {
		die();
	}

	try {
	    // Returns a valid address
	    $receiverAddress = $lob->addresses()->create(array(
	        'name'              => 'Harry Zhang', // Required
	        'address_line1'     => '123 Test Street', // Required
	        'address_line2'     => 'Unit 199', // Optional
	        'address_city'      => 'Mountain View', // Required
	        'address_state'     => 'CA', // Required
	        'address_country'   => 'US', // Required - Must be a 2 letter country short-name code (ISO 3316)
	        'address_zip'       => '94085', // Required
	        'email'             => 'harry@lob.com', // Optional
	        'phone'             => '5555555555', // Optional
	    ));
	} catch (\Lob\Exception\ValidationException $e) {
		die();/*dies*/
	}



	try {
	    // Returns a valid postcard
	    $postcard = $lob->postcards()->create(array(
	        'name'          => 'Demo Postcard job', // Required
	        'to'            => $receiverAddress['id'], // Required
	        'from'          => $senderAddress['id'], // Optional
	        'message'       => 'This an example message on back of the postcard'/*, // Optional
	        // For both front and back parameters, you can also provide a public URL
	        'front'         => '@'.realpath('/users/m/f/mfurland/www-root/GrandMail/Shiney.pdf'), // Optional
	        'back'          => '@'.realpath('/path/to/your/file/goblue.pdf'), // Optional//*/
	    ));
	} catch (\Lob\Exception\ValidationException $e) {
		die();
	}

	echo "<pre>";
	print_r($postcard)

?>
