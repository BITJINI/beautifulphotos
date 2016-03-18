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

<?php

if($_POST['order_id'] != ''){
$url4 = 'https://beautifulphotosproject.herokuapp.com/delete_order/';
$options4 = array(
  'http' => array(
    'header'  => array(
                  'ORDER-ID: '.$_POST['order_id'],
                ),
    'method'  => 'GET',
  ),
);
$context4 = stream_context_create($options4);
$output4 = file_get_contents($url4, false,$context4);

$arr4 = json_decode($output4,true);

if($arr4['status'] == 200){
  echo "Order deleted";
}

}


?>


<div id="loadingPleaseWait"><div><h6>Loading, please wait...</h6></div></div>

<h4>Order Details</h4>

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
    <th>Quantity</th>
    <th>Shipping Address</th>
    <th>Amount</th>
    <th>Status</th>
   <!--  <th>Link</th> -->
    <th>Download</th>
    <th>Action</th>
  </tr>

<?php 
for ($x = 0; $x < count($arr3[0]['results']); $x++) { ?>

  <tr>
    <td><?php echo $arr3[0]['results'][$x]['Order Id']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Order No']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Date']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Name']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Email']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Phone']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Address']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Merchandise Type']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Quantity']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Shipping Address']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Amount']; ?></td>
    <td><?php echo $arr3[0]['results'][$x]['Status']; ?></td>
   <!--  <td><?php echo $arr3[0]['results'][$x]['Link']; ?></td> -->
    <td>  <a download="image.jpg" href="<?php echo $arr3[0]['results'][$x]['Link']; ?>" title="Image">
            <!-- <img alt="Image" src="<?php echo $arr3[0]['results'][$x]['Link']; ?>"> -->
            <h4>Download</h4>
          </a>
    </td>
    <td> 
          <form role="form" action="" method="post">
          <div class="form-group">
            <input type="hidden" name="order_id" value="<?php echo $arr3[0]['results'][$x]['Order Id']; ?>" class="form-control" required/><br>
          </div>
          
          <button onclick="show_wait_msg()" type="submit" class="btn btn-md round">Delete</button>
        </form>


    </td>
  </tr>

<?php  } 
?>
  
</table>


</body>
</html>



