<?php
/*
*	@api-of-TV-Calendar getmyshows.php
*
*	@author:MingGao
*
*	@verson:0.2.0 ,finished on 17rh Feb 2015
*
*	@descripetion: get my TV shows
*/
namespace TVCalendarAPI\api;
class myshows(){
function get()
{
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
	$my = curl_init("http://www.pogdesign.co.uk/cat/profile/all-shows");
 	curl_setopt($my, CURLOPT_COOKIEFILE, $cookie_jar);
	curl_setopt($my, CURLOPT_RETURNTRANSFER, 1);
	$html = curl_exec($my);
	curl_close($my);
//*/
	$flag = true;
	$msg = "none";
	$data = array();
	if (preg_match_all("/<a href=\"\/cat\/profile\/unwatched-episodes\/([^\"]+).*?background-image: url\(([^\)]+)/", $html, $shows, PREG_SET_ORDER)) {
		foreach ($shows as $i => $show) {
			$data[$i] = array(
				'name' => $show[1],
				'imageurl' => "http://www.pogdesign.co.uk" . $show[2]
			);
		}
	}

	return json_encode(array(
		"status" => $flag,
		"msg" => $msg,
		"data" => $data,
	));
}}