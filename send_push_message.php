<!DOCTYPE html>
<html>
<head>
<style type="text/css">
#table-wrapper {
  position:relative;
}
#table-scroll {
  height:150px;
  overflow:auto;  
  margin-top:20px;
}

#table-wrapper table * {
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}
#table-wrapper th,td{
	padding:8px;
	text-align: left;
	border:1px solid black;
}

</style>
</head>
<body>
<?php
  $url_get_list_of_devices = 'https://beautifulphotosproject.herokuapp.com/register_device/list/';
  $options_get_list_of_devices = array(
    'http' => array(
      /*'header'  => array(
                          'MESSAGE: '.$msg,
                          ),*/
      'method'  => 'GET',
    ),
  );
  $context_get_list_of_devices = stream_context_create($options_get_list_of_devices);
  $output_get_list_of_devices = file_get_contents($url_get_list_of_devices, false,$context_get_list_of_devices);
  $arr_get_list_of_devices = json_decode($output_get_list_of_devices,true);
  /*echo $arr_get_list_of_devices;*/
  
?>


<?php

if(isset($_POST['submit_btn_2']) and !empty($_FILES['fileToUpload']['name']) ){
  /*echo $_FILES["fileToUpload"]["name"];*/

  /*Upload Files*/
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 4; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $names= $randomString.rand(0, 9999).".jpg";


            /*Get Signed Urls*/
            $url = 'https://beautifulphotosproject.herokuapp.com/get_signed_url_notification/';
            $data = array('image_list' => [$names]);

            $options = array(
              'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($data),
              ),
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $arr = json_decode($result,true);

            echo $arr[0]["0"];

            /*var_dump(filesize($_FILES["fileToUpload"]["tmp_name"]));*/

            /*Upload Images in signed urls*/
            $url_upload = $arr[0]["0"];
            $filename = $_FILES["fileToUpload"]["tmp_name"];
            $file = fopen($filename, "rb");
            $data = fread($file, filesize($filename));

            /*var_dump($data);*/

            $options_upload = array(
              'http' => array(
                'header'  => "Content-type: \r\n",
                'method'  => 'PUT',
                'content' => $data,
              ),
            );
            $context_upload  = stream_context_create($options_upload);
            $result_upload = file_get_contents($url_upload, false, $context_upload);
/*
            var_dump($result_upload);*/
            $arr_upload = json_decode($result_upload,true);

        
            $url_update_doc_tab = 'https://beautifulphotosproject.herokuapp.com/upload_notification_image/';
            $data_update_doc_tab = array('image_id' => $arr[0]['id']);

            $options_update_doc_tab = array(
              'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data_update_doc_tab),
              ),
            );
            $context_update_doc_tab  = stream_context_create($options_update_doc_tab);
            $result_update_doc_tab = file_get_contents($url_update_doc_tab, false, $context_update_doc_tab);
            $arr_update_doc_tab = json_decode($result_update_doc_tab,true);


}

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
 
 		  $url_send_message = 'https://beautifulphotosproject.herokuapp.com/send_push_message/';
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
<br><br>

<h4 style="font-size:30px">Notification Image</h4>
<form action="send_push_message.php" enctype="multipart/form-data" method="post">
<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
<button name="submit_btn_2" value="submit_btn_2" style="background-color:#E0E0E0;width:200px;height:40px" type="submit">Upload</button>
</form>


<h4 style="font-size:30px">Notification</h4>
<h5 style="color:red;font-size:19px"><?php echo $error ?></h5>

<form action="send_push_message.php" method="post">

  Message<br>
  <textarea type="text" name="message" rows="10" cols="50" value="message"></textarea>



  <br><br>
  Select a Template<br>
  <select name="template">
    <option value="" selected></option>
    <option value="Hello from Beautifulphotos.">Hello from Beautifulphotos.</option>
    <option value="Have a good day. Regards from Beautifulphotos.">Have a good day. Regards from Beautifulphotos.</option>
    <option value="Have you designed your Mug yet?">Have you designed your Mug yet?</option>
    <option value="Good morning and have a great day from Beautifulphotos.">Good morning and have a great day from Beautifulphotos.</option>
  </select>

  <br><br><br><br>
  <button name="submit_btn" value="submit_btn" style="background-color:#E0E0E0;width:200px;height:40px" type="submit">Send</button>
</form> 

<br><br>
<h4>List Of Devices</h4>

<div id="table-wrapper">
  <div id="table-scroll">
    <table>
        <thead>
            <tr>
                <th>Serial No.</th>
			    <th>Name</th> 
			    <th>Platform</th>
			    <th>Device Token</th>
			    <th>Is Active</th>
			    <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php for($x=0;$x<count($arr_get_list_of_devices);$x++){?>
            <tr>
            	<td><?php echo $x+1 ?></td>
		    	<td><?php echo $arr_get_list_of_devices[$x]['name'] ?></td>
		    	<td><?php echo $arr_get_list_of_devices[$x]['platform'] ?></td>
		    	<td><?php echo $arr_get_list_of_devices[$x]['device_token'] ?></td>
		    	<td><?php echo $arr_get_list_of_devices[$x]['is_active'] ?></td>
		    	<td><?php echo $arr_get_list_of_devices[$x]['date'] ?></td>
		    </tr>
        </tbody>
        <?php }?>
    </table>
  </div>
</div>

</body>
</html>
