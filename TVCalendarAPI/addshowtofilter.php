<?php
/*
*	@api-of-TV-Calendar addshowtofilter.php
*
*	@author:MingGao
*
*	@verson:0.2.0 ,finished on 17rh Feb 2015
*
*	@descripetion: add TV show to filter
*/

	$post_data = array(
		'username' => $_GET['username'],
		'password' => $_GET['password'],
		'sub_login' => 'Account Login'
	);
//*/
	$cookie_jar = tempnam('./tmp','TVCalendarCookie');
	$ch = curl_init("http://www.pogdesign.co.uk/cat/");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
 	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_exec($ch);
	curl_close($ch);
//*/
	$add_data = array(
		'filter' => 'adding',
		'shid' => $_GET['id']
	);
//*/
	$add = curl_init("http://www.pogdesign.co.uk/cat/filterhandle");
	curl_setopt($add, CURLOPT_POST, 1);
	curl_setopt($add, CURLOPT_AUTOREFERER, 1);
	curl_setopt($add, CURLOPT_FOLLOWLOCATION, 1);
 	curl_setopt($add, CURLOPT_COOKIEFILE, $cookie_jar);
	curl_setopt($add, CURLOPT_NOBODY, 1);
	curl_setopt($add, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($add, CURLOPT_POSTFIELDS, $add_data);
	curl_exec($add);
//*/
	$flag = true;
	$msg = "none";
	if (curl_getinfo($add, CURLINFO_HTTP_CODE) != 302) {
		$flag = false;
	}
	curl_close($add);

	echo json_encode(array(
		"status" => $flag,
		"msg" => $msg,
	));
//*/
?>