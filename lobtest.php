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
    $address = $lob->addresses()->create(array(
        'name'              => 'test', // Required
        'address_line1'     => '123 Test Street', // Required
        'address_line2'     => '', // Optional
        'address_city'      => 'Mountain View', // Required
        'address_state'     => 'CA', // Required
        'address_country'   => 'US', // Required - Must be a 2 letter country short-name code (ISO 3316)
        'address_zip'       => '94085', // Required
        'email'             => '' // Optional
        'phone'             => ''
    ));
	} catch (\Lob\Exception\ValidationException $e) {
	    // Do something
	}

	try {
	    // Returns a valid object
	    $object = $lob->objects()->create(array(
	        'name'        => 'TEST' // Required
	        'file'        => '@'.realpath('/path/to/your/file/goblue.pdf'), // Required
	        'setting_id'  => $setting['id'], // Required
	        'quantity'    => 1, // Optional
	    ));
	} catch (\Lob\Exception\ValidationException $e) {
	    // Do something
	}

	echo "<pre>";
	print_r($object)

?>