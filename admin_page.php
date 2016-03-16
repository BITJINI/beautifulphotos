<html>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
<body>

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
    <th>Status</th>
   <!--  <th>Link</th> -->
    <th>Download</th>
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
    <td><?php echo $arr3[0]['results'][$x]['Status']; ?></td>
   <!--  <td><?php echo $arr3[0]['results'][$x]['Link']; ?></td> -->
    <td>  <a download="image.jpg" href="<?php echo $arr3[0]['results'][$x]['Link']; ?>" title="Image">
            <!-- <img alt="Image" src="<?php echo $arr3[0]['results'][$x]['Link']; ?>"> -->
            <h4>Download</h4>
          </a>
    </td>
  </tr>

<?php  } 
?>
  
</table>


</body>
</html>



