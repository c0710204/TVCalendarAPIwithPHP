<?php
	/*
	*	@api-of-TV-Calendar
	* 	
	*	@author:MingGao & XingGu & zhuyifan
	*
	*	@verson:0.1.0,finished on 16rh Feb 2015
	*
	*	@descripetion: a small api which quoted from http://www.pogdesign.co.uk/cat/
	*		It echo the following data structure with json encode:
	*		{ status: ture/false,
	*		  msg: "none",
	*		  data: { "date": [ { name: "the name of episode",
	*		  					  season: "a digit from 0 to 99",
	*		  					  episode: "a digit from 0 to 99"
	*		  					},
	*		  					{ another... }
	*		  				   ],
	*		  		  "anotherdate..."
	*		  		}
	*		}
	*/

	$post_data = array(
		'username' => $_GET['username'],
		'password' => $_GET['password'],
		'sub_login' => 'Account Login'
	);

//*/
	$cookie_jar = tempnam('./tmp','TVCalendarCookie');
	$ch = curl_init("http://www.pogdesign.co.uk/cat/");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);  
 	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	$contents_get_first = curl_exec($ch);
	curl_close($ch);
//*/
	// disable td+noday
	$contents_get_first=str_replace("<td class=\"noday\"></td>","",$contents_get_first);

	// can get off the head by the label: <table id="cal">
	$contents_without_head = explode("<table id=\"cal\">", $contents_get_first);
	// use the same method to get off the footers
	$contents_without_foot = explode("</table>", $contents_without_head[1]);
	$target_first = $contents_without_foot[0];
	unset($contents_get_first);
	unset($contents_without_head);
	unset($contents_without_foot);

	// $whole_cal is the target array
	$whole_cal = array();
	// use "<td id=" to divide the page into every day's html code
	$target_second = explode("<td id=", $target_first);
	// use following code to test wether we get the right pieces
	unset($target_first);

	$flag=true;
	$msg="none";
	$target_second_count = count($target_second);
	for ($i = 1; $i < $target_second_count; $i++) { 
		// for every day, use a regular expression to get this day's date
		if (preg_match("/\d{1,2}-\d{1,2}-\d{4}/", $target_second[$i], $day)){
			$whole_cal["{$day[0]}"] = array();
		} else {
			$flag=false;
			$msg="find day is wrong";
		}
		// get all episodes in this day
		if (preg_match_all('/[^\/]+\/Season-\d{1,2}\/Episode-\d{1,2}/i', $target_second[$i], $episode)) {
			$episode_count = count($episode[0]);
			for ($j = 0; $j < $episode_count; $j++) {
				$sub_target = explode("/", $episode[0][$j]);
				preg_match("/\d{1,2}/", $sub_target[1], $season_data);
				preg_match("/\d{1,2}/", $sub_target[2], $episode_data);
				$whole_cal["{$day[0]}"][$j] = array(
					'name' => $sub_target[0],
					'season' => $season_data[0],
					'episode' => $episode_data[0]
				);
				unset($season_data);
				unset($episode_data);
			}
		}
	}
	unset($target_second);
	unset($day);
	unset($episode);
	unset($sub_target);

	echo json_encode(array(
		"status"=>$flag,
		"msg"=>$msg,
		"data"=>$whole_cal,
	));
//*/
?>