<?php
/*
*	@api-of-TV-Calendar registeraccount.php
*
*	@author:MingGao
*
*	@verson:0.2.0 ,finished on 17rh Feb 2015
*
*	@descripetion: register account
*/

	$post_data = array(
		'email' => $_GET['email'],
		'password' => $_GET['password'],
		'passwordconf' => $_GET['passwordconf'],
		'submit_register' => 'Register Account'
	);
//*/
	$cookie_jar = tempnam('./tmp','TVCalendarCookie');
	$ch = curl_init("http://www.pogdesign.co.uk/cat/register_account");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
 	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_exec($ch);
//*/
	$flag = true;
	$msg = "none";
	if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
		$flag = false;
	}
	curl_close($ch);

	echo json_encode(array(
		"status" => $flag,
		"msg" => $msg,
	));
//*/
?>