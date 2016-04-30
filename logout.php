<?php

$url_logged = 'https://testing-beautifulphotosproject.herokuapp.com/update_logged_in/?access_token=QIw10aWGHb2kchy1huq5o3CyJ88kR9';
$options_logged = array(
  'http' => array(
    'header'  => array(
                  'LOGGED-IN: 0',
                ),
    'method'  => 'GET',
  ),
);
$context_logged = stream_context_create($options_logged);
$output_logged = file_get_contents($url_logged, false,$context_logged);
/*echo $output2;*/
$arr_logged = json_decode($output_logged,true);

echo "<script>location='index.php'</script>";
?>