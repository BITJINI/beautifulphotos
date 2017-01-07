<html>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
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

$url_check = 'https://beautifulphotosproject.herokuapp.com/update_logged_in/check/?access_token=QIw10aWGHb2kchy1huq5o3CyJ88kR9';
$options_check = array(
  'http' => array(
    /*'header'  => array(
                  'LOGGED-IN: 1',
                ),*/
    'method'  => 'GET',
  ),
);
$context_check = stream_context_create($options_check);
$output_check = file_get_contents($url_check, false,$context_check);
/*echo $output_check;*/
$arr_check = json_decode($output_check,true);
/*echo $arr_check;*/

if($arr_check['status'] == 400){
      echo "<script>location='index.php'</script>";
}else{
    /*echo "<script>location='index.php'</script>"; */ 
}


?>


<?php
if(isset($_POST['status_submit'])){
$url_mail_status = 'https://beautifulphotosproject.herokuapp.com/send_mail/?access_token=QIw10aWGHb2kchy1huq5o3CyJ88kR9';
$options_mail_status = array(
  'http' => array(
    'header'  => array(
                  'ORDER-ID: '.$_POST['status_order_id'],
                  'EMAIL: '.$_POST['status_email'],
                  'STATUS: '.$_POST['order_status'],
                ),
    'method'  => 'GET',
  ),
);
$context_mail_status = stream_context_create($options_mail_status);
$output_mail_status = file_get_contents($url_mail_status, false,$context_mail_status);
$arr_mail_status = json_decode($output_mail_status,true);
/*echo $arr_mail_status[0]['status'];*/
/*if($arr_mail_status[0]['status']==200){
  echo "<script>alert('Status set and Mail sent to the user')</script>";
}*/
}
?>

<?php
$url3 = 'https://beautifulphotosproject.herokuapp.com/get_details/';
$options3 = array(
  'http' => array(
    /*'header'  => array(
                  'USERNAME: '.$_POST['username'],
                  'PASSWORD: '.$_POST['password'],
                ),*/
    'method'  => 'GET',
  ),
);
$context3 = stream_context_create($options3);
$output3 = file_get_contents($url3, false,$context3);
/*echo $output3;*/
$arr3 = json_decode($output3,true);
/**/
?>

<a href="logout.php" id="log_out">Log Out</a>
<div id="loadingPleaseWait"><div><h6>Loading, please wait...</h6></div></div>


<h4>Order Details</h4>

<div style="text-align:right;margin-top:-3%;margin-right:2%">
<button style="background-color:#E0E0E0 ;width:200px;height:40px" onclick="location.href = 'send_push_message.php';">Notification</button>
</div>
<br><br>
<table>
  <tr>
    <!-- <th>City Id</th> -->
    <th>Order Id</th>
    <th>Order No.</th>
    <th>Date</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Merchandise Type</th>
    <th>Copy</th>
    <th>Shipping Address</th>
    <th>Dimension</th>
    <th>Amount</th>
    <th>Count</th>
    <th>Photos Uploaded</th>
    <th>Upload Status</th>
    <th>Order Status</th>
   <!--  <th>Link</th> -->
    <th>Select Status</th>
    <th>Download</th>
    <th>Action</th>
  </tr>

<?php 
for ($x = 0; $x < count($arr3[0]['results']); $x++) { 

$q= str_replace('{','',$arr3[0]['results'][$x]['Link']);
$r= str_replace('}','',$q);
$myString1=$r;
$myArray1 = explode(',', $myString1);
$photos_uploaded=count($myArray1);

if($photos_uploaded >= $arr3[0]['results'][$x]['Count']){
  $upload_status="Upload Complete";
}else{
  $upload_status="Upload Pending";
}

?>

  <tr>
    <td><?php echo $arr3[0]['results'][$x]['Order Id']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Order No']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Date']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Name']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Email']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Phone']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Address']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Merchandise Type']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Copy']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Shipping Address']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Dimension']; ?></td> 
    <td><?php echo $arr3[0]['results'][$x]['Amount']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Count']; ?></td>
    <td><?php echo $photos_uploaded ?></td>
    <td><?php echo $upload_status ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Status']; ?></td>
   <!--  <td><?php echo $arr3[0]['results'][$x]['Link']; ?></td> -->
    <!-- <td>  <a download="<?php echo $arr3[0]['results'][$x]['Order No']; ?>" href="<?php echo $arr3[0]['results'][$x]['Link']; ?>" title="Image">
            Download
          </a>
    </td> -->

    <td>
    <form method="post" action="admin_page.php">
        <input type="hidden" name="status_order_id" value="<?php echo $arr3[0]['results'][$x]['Order Id']; ?>"></input>
        <input type="hidden" name="status_email" value="<?php echo $arr3[0]['results'][$x]['Email']; ?>"></input>
        <select name="order_status" method="post">
          <option value="Received" selected>Received</option>
          <option value="In Process">In Process</option>
          <option value="Prepared">Prepared</option>
          <option value="Dispatched">Dispatched</option>
          <option value="Cancelled">Cancelled</option>
          <option value="Delivered">Delivered</option>
          <option value="Closed">Closed</option>
        </select>
      
        <button name="status_submit" value="status_submit" style="margin-top:6% !important" type="submit">Select</button>
      
    </form>
    </td>

    <td>
    <?php/* echo $arr3[0]['results'][$x]['Link']; */?>
    <form method="post" action="download.php">
    <input type="hidden" name="order_email" value="<?php echo $arr3[0]['results'][$x]['Email']; ?>"></input>
    <input type="hidden" name="order_name" value="<?php echo $arr3[0]['results'][$x]['Order Id']; ?>"></input>
    <input type="hidden" name="image_link" value="<?php echo $arr3[0]['results'][$x]['Link']; ?>"></input>
    <button type="submit">Download</button>
    </td>

    </form>
   


    <td> 
          <form role="form" action="delete.php" method="post">
          <div class="form-group">
            <input type="hidden" name="order_id_delete" value="<?php echo $arr3[0]['results'][$x]['Order Id']; ?>" class="form-control" required/><br>
          </div>
          <input type="hidden" name="image_link_delete" value="<?php echo $arr3[0]['results'][$x]['Link']; ?>"></input>
          <button onclick="show_wait_msg()" type="submit" class="btn btn-md round">Delete</button>
        </form>


    </td>
  </tr>

<?php  } 
?>
  
</table>


</body>
</html>



