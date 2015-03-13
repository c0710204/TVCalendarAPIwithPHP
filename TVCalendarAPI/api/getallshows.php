<?php
/*
*	@api-of-TV-Calendar getallshows.php
*
*	@author:MingGao
*
*	@verson:0.2.0 ,finished on 17rh Feb 2015
*
*	@descripetion: get all TV shows
*/
namespace TVCalendarAPI\api;
function getallshows()
{

//*/
	$ch = curl_init("http://www.pogdesign.co.uk/cat/showselect.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$html = curl_exec($ch);
	curl_close($ch);
//*/
	$flag = true;
	$msg = "none";
	$data = array();
	if (preg_match_all("/<div id=\"check([^\"]+).*?<img src=\"([^\"]+).*?<strong>([^<]+)/s", $html, $shows, PREG_SET_ORDER)) {
		foreach ($shows as $i => $show) {
			$data[$i] = array(
				'id' => $show[1],
				'name' => $show[3],
				'imageurl' => "http://www.pogdesign.co.uk" . $show[2]
			);
		}
	}

	return json_encode(array(
		"status" => $flag,
		"msg" => $msg,
		"data" => $data,
	));
}
//*/
?>