<?php
/*
echo $_POST['image_link'];*/
$url_download = 'https://beautifulphotosproject.herokuapp.com/download/';
$options_download = array(
  'http' => array(
    'header'  => array(
                  'IMAGE-LINK: '.$_POST['image_link'],
                ),
    'method'  => 'GET',
  ),
);
$context_download = stream_context_create($options_download);
$output_download = file_get_contents($url_download, false,$context_download);
/*echo $output_download;*/
$arr_download = json_decode($output_download,true);
/*echo $arr_download[0]['url'];*/

header('location: '.$arr_download[0]['url']);
?>