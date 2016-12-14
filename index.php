<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SugarCRM API</title>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
<section class="getId">
<?php

// specify the REST web service to interact with

$url = 'http://localhost/SugarCE-Full-6.5.24/service/v2/rest.php';

// Open a curl session for making the call
$curl = curl_init($url);

// Tell curl to use HTTP postArgs

curl_setopt($curl, CURLOPT_POST, true);

// Tell curl not to return headers, but do return the response

curl_setopt($curl, CURLOPT_HEADER, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);



// Set the POST arguments to pass to the Sugar server

$parameters = array(
    'user_auth' => array(
        'user_name' => 'admin',
        'password' => md5('admin'),
        ),
    );

$json = json_encode($parameters);
$postArgs = array(
    'method' => 'login',
    'input_type' => 'JSON',
    'response_type' => 'JSON',
    'rest_data' => $json,
    );
curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs);

// Make the REST call, returning the result
$response = curl_exec($curl);
// Convert the result from JSON format to a PHP array
$result = json_decode($response);
if ( !is_object($result) ) {
    die("Error handling result.\n");
}
if ( !isset($result->id) ) {
    die("Error: {$result->name} - {$result->description}\n.");
}
// Echo out the session id
echo "Your ID is : ".$result->id."<br />";
$session = $result->id;

?>
</section>
<div class="output">

</div>
</body>
</html>