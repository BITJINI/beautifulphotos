<!DOCTYPE html>
<html>
<body>

<?php

if($_POST['message'] == '' && $_POST['template'] == '' && isset($_POST['submit_btn'])){
	$error="Message or template is required";
}
else if($_POST['message'] != '' && $_POST['template'] != '' && isset($_POST['submit_btn'])){
	$error="Either message or template required";
}
else if(isset($_POST['submit_btn'])){

 if($_POST['message'] != ''){
 	$msg=$msg=$_POST['message'];
 }else{
 	$msg=$msg=$_POST['template'];
 }
 
 		  $url_send_message = 'https://test2-beautifulphotosproject.herokuapp.com/send_push_message/';
		  $options_send_message = array(
		    'http' => array(
		      'header'  => array(
		                          'MESSAGE: '.$msg,
		                          ),
		      'method'  => 'GET',
		    ),
		  );
		  $context_send_message = stream_context_create($options_send_message);
		  $output_send_message = file_get_contents($url_send_message, false,$context_send_message);
		  $arr_send_message = json_decode($output_send_message,true);
		  if($arr_send_message['status'] == 200){
		    $error="Notification Sent";
            $_POST = array();
		  }
 
}

?>

<a href="admin_page.php">Back</a>

<h4 style="font-size:30px">Push Notification</h4>
<h5 style="color:red;font-size:19px"><?php echo $error ?></h5>
<form action="send_push_message.php" method="post">
  Message<br>
  <textarea type="text" name="message" rows="10" cols="50" value="message"></textarea>
  
  <br><br>
  Select a Template<br>
  <select name="template">
    <option value="" selected></option>
    <option value="Thank you for using Beautiful Photos!">Thank you for using Beautiful Photos!</option>
    <option value="New Year Offers coming soon. Please have a look at our website!">New Year Offers coming soon. Please have a look at our website!</option>
    <option value="Have a Nice Day!">Have a Nice Day!</option>
    <option value="Good Morning!">Good Morning!</option>
  </select>

  <br><br><br><br>
  <button name="submit_btn" value="submit_btn" style="background-color:#E0E0E0;width:200px;height:40px" type="submit">Send Push Notification</button>
</form> 


</body>
</html>
