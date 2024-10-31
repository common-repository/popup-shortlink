<?php

require_once('../../../wp-load.php');

$ps_activation = get_option('ps_activation');
$ps_url_shortner = get_option('ps_url_shortner');
$ps_bitly_user = get_option('ps_bitly_user');
$ps_bitly_api = get_option('ps_bitly_api');

if(empty($ps_activation))
{
	exit;
}

if($ps_activation == 'non')
{
	exit;
}

if(empty($ps_url_shortner))
{
	exit;
}

if(empty($_GET['l']))
{
	exit;
}
else
{
	$link_api = trim($_GET['l']);
}

if($ps_url_shortner == 'bitly')
{

	$login = $ps_bitly_user;
	$appkey = $ps_bitly_api;
	$format = "xml";
	$version = "2.0.1";

	$bitly = 'http://api.bit.ly/shorten?version=' . $version . '&longUrl=' . urlencode($link_api) . '&login=' . $login . '&apiKey=' . $appkey . '&format=' . $format;

	$response = file_get_contents($bitly);

	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response, true);
		$get_api = $json['results'][$link_api]['shortUrl'];
	}
	else
	{
		$xml = simplexml_load_string($response);
		$get_api = 'http://bit.ly/' . $xml->results->nodeKeyVal->hash;
	}

	echo $get_api;

}
elseif($ps_url_shortner == 'qrcx')
{

	$get_api = file_get_contents("http://qr.cx/api/?longurl=" . $link_api);

	echo $get_api;

}
elseif($ps_url_shortner == 'tk')
{

	$get_api = file_get_contents("http://api.dot.tk/tweak/shorten?long=http://pirmax.fr/");

	$get_api_explode = explode("http://", $get_api);
	$get_api = $get_api_explode[1];
	$get_api = 'http://' . $get_api;

	echo $get_api;

}
elseif($ps_url_shortner == 'tinyurl')
{

	$get_api = file_get_contents("http://tinyurl.com/api-create.php?url=" . $link_api);

	echo $get_api;

}

exit;

?>