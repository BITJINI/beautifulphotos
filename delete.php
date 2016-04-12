

<?php

$url4 = 'https://beautifulphotosproject.herokuapp.com/delete_order/';
$options4 = array(
  'http' => array(
    'header'  => array(
                  'ORDER-ID: '.$_POST['order_id_delete'],
                ),
    'method'  => 'GET',
  ),
);
$context4 = stream_context_create($options4);
$output4 = file_get_contents($url4, false,$context4);

$arr4 = json_decode($output4,true);





$a= str_replace('{','',$_POST['image_link_delete']);
$b= str_replace('}','',$a);
$myString=$b;
$myArray = explode(',', $myString);
/*echo $myArray;*/


for ($x = 0; $x < count($myArray); $x++) {
    $url_delete = 'https://beautifulphotosproject.herokuapp.com/delete_images/';
	$options_delete = array(
  		'http' => array(
    		'header'  => array(
                  'LINK-ID: '.$myArray[$x],
                ),
    		'method'  => 'GET',
  		),
	);
	$context_delete = stream_context_create($options_delete);
	$output_delete = file_get_contents($url_delete, false,$context_delete);
	/*echo $output_download;*/
	
	$arr_delete = json_decode($output_delete,true);

	/*if($arr_delete['status'] == 200){
  		echo "Image deleted";
	}*/

} 


header('location: admin_page.php');


?>