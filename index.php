<!-- http://localhost/foodromeo/sign-up.php -->

<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="admin_login.css">

<script type="text/javascript">

function hide_wait_msg ()
{
    document.getElementById('loadingPleaseWait').style.display = 'none';
}

function show_wait_msg ()
{
     document.getElementById('loadingPleaseWait').style.display = 'block';
}

</script>
</head>
<body onload="hide_wait_msg()">


<?php
/*if($_POST['username'] != '' && $_POST['password'] != ''){
$url2 = 'https://testing-beautifulphotosproject.herokuapp.com/is_admin_login/';
$options2 = array(
  'http' => array(
    'header'  => array(
                  'USERNAME: '.$_POST['username'],
                  'PASSWORD: '.$_POST['password'],
                ),
    'method'  => 'GET',
  ),
);
$context2 = stream_context_create($options2);
$output2 = file_get_contents($url2, false,$context2);
$arr2 = json_decode($output2,true);
if($arr2['status']==200){

                          $url_logged = 'https://testing-beautifulphotosproject.herokuapp.com/update_logged_in/?access_token=QIw10aWGHb2kchy1huq5o3CyJ88kR9';
                          $options_logged = array(
                            'http' => array(
                              'header'  => array(
                                            'LOGGED-IN: 1',
                                          ),
                              'method'  => 'GET',
                            ),
                          );
                          $context_logged = stream_context_create($options_logged);
                          $output_logged = file_get_contents($url_logged, false,$context_logged);
                          $arr_logged = json_decode($output_logged,true);
  echo "<script>location='admin_page.php'</script>";
}else{
}

}*/

if($_POST['username'] != '' && $_POST['password'] != ''){
  if($_POST['username'] == 'test' && $_POST['password'] == 'bitjini'){
      echo "<script>location='admin_page.php'</script>";
  }

}

?>




<div class="container-fluid"><!-- MAIN CONTAINER Begins -->
    
<div id="loadingPleaseWait"><div><h6>Loading, please wait...</h6></div></div>


<?php /*if($arr2['status']==400 || $arr['status'] == 401){
          $error="Invalid Admin Credentials";
}*/?>



  <div style="margin-left:10%;margin-top:5%">   
    <p id="form_title">Admin Console</p>

      <h6 style="color:#F03F32;margin-left:0%"><?php echo $error;?></h6>
 
        <form role="form" action="" method="post">
          <div class="form-group">
            <input type="text" name="username" placeholder="Username" class="form-control" id="name" required/><br>
            <input type="password" name="password" placeholder="Password" class="form-control" id="pwd" required>
          </div>
          
          <button onclick="show_wait_msg()" type="submit" class="btn btn-md round">LOG IN</button>
        </form>
  </div>
</body>
</html>



