<?php
/*
echo $_POST['image_link'];*/

/*echo $_POST['image_link'];*/

$a= str_replace('{','',$_POST['image_link']);
$b= str_replace('}','',$a);
$myString=$b;
$myArray = explode(',', $myString);
/*echo $myArray;*/

$download_urls= array();

for ($x = 0; $x < count($myArray); $x++) {
    $url_download = 'https://beautifulphotosproject.herokuapp.com/download/';
	$options_download = array(
  		'http' => array(
    		'header'  => array(
                  'IMAGE-ID: '.$myArray[$x],
                ),
    		'method'  => 'GET',
  		),
	);
	$context_download = stream_context_create($options_download);
	$output_download = file_get_contents($url_download, false,$context_download);
	/*echo $output_download;*/
	
	$arr_download = json_decode($output_download,true);
	$download_urls[$x]=$arr_download[0]['url'];
} 


echo $download_urls[0];
echo "<br>";
echo $download_urls[1];

/*header('location: '.$arr_download[0]['url']);
*/?>