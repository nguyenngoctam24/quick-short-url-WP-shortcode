<?php
function curl($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$source = curl_exec($ch);
	return $source;
	curl_close($ch);
}
/* Setup Ouo.io */
$api['ouo.io'] = 'YOUR API KEY'; // <-- Replace with your API key
/* 	How to:
	Go to http://ouo.io/manage/tools/quick-link to get your API Key.
	Ex: http://ouo.io/s/HwMoZSDE?s=yourdestinationlink.com.
	API key is 'HwMoZSDE'.
	Replace 'YOUR API KEY' with your API.
*/
/* End Ouo.io */

/* Setup shorte.st */
$api['shorte.st'] = 'YOUR API KEY';  // <-- Replace with your API key
/* How to : 
	Go to https://shorte.st/tools/quick to get your API Key.
	Press Copy button to Copy your API key.
	Replace 'YOUR API KEY' with your API.
*/
/* End shorte.st */

/* Setup adf.ly  */
$uid['adf.ly'] = 'YOUR ID'; // <-- Replace with your user ID
$api['adf.ly'] = 'YOUR API KEY'; // <-- Replace with your API key
/* How to:
	Go to https://adf.ly/publisher/tools#tools-api to get your public API key and your User ID
	Replace 'YOUR ID' with your user ID and 'YOUR API KEY' with your public API;
*/
/* End adf.ly  */

function short($a,$b)
{	
	global $api;
	if(isset($a['ouo']))
	{	
		$url = 'http://ouo.io/api/'.$api['ouo.io'].'?s='.$a['ouo'];
		if(!empty($b))
		{	
			return '<a href="'. curl($url) .'" '.'target="_blank">'. $b .'</a>';
		}else
		{
			return '<a href="'. curl($url) .'" '.'target="_blank">'. curl($url) .'</a>';
		}				
	}
	if(isset($a['shst']))
	{	
		$url = 'https://api.shorte.st/s/'.$api['shorte.st'].'/'.$a['shst'];
		if(!empty($b))
		{
			return '<a href="'. json_decode(curl($url))->shortenedUrl .'" '. 'target="_blank">'. $b .'</a>';
		}else
		{
			return '<a href="'. json_decode(curl($url))->shortenedUrl .'" '.'target="_blank">'. json_decode(curl($url))->shortenedUrl .'</a>';
		}
	}
	if(isset($a['adf']))
	{
		global $uid;
		$url = 'http://api.adf.ly/api.php?key='.$api['adf.ly'].'&uid='.$uid['adf.ly'].'&advert_type=int&domain=adf.ly&url='.$a['adf'];
		if(isset($b))
		{
			return '<a href="'. curl($url) .'" ' .'target="_blank">'.$b.'</a>';
		}else
		{
			return '<a href="'. curl($url) .'" '.'target="_blank">'. curl($url) .'</a>';
		}
	}
}
add_shortcode( 'qs', 'short' );
?>
