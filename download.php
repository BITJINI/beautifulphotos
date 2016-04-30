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
    $url_download = 'https://testing-beautifulphotosproject.herokuapp.com/download/';
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



$files = $download_urls;

# create new zip opbject
$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach($files as $file){

    # download file
    $download_file = file_get_contents($file);

    $parts = explode("?",$file); 

    #add it to the zip
    $zip->addFromString(basename($parts['0']),$download_file);

}

# close zip
$zip->close();

# send the file to the browser as a download
header('Content-disposition: attachment; filename=Order-Id '.$_POST['order_name'].'.zip');
header('Content-type: application/zip');
readfile($tmp_file);

/*header('location: '.$arr_download[0]['url']);
*/?>